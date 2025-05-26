#!/bin/bash
set -e

chown -R www-data:www-data storage

if [ ! -d "vendor" ]; then
    composer install --no-interaction --optimize-autoloader
fi

php artisan key:generate

# Buat folder storage/app/public jika belum ada
mkdir -p storage/app/public

# Bersihkan symlink jika sudah ada dan salah
if [ -e "public/storage" ]; then
    rm -rf public/storage
fi

# Buat symlink public/storage
php artisan storage:link || true

# Install Nodejs Deps
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.3/install.sh | bash

export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"

nvm install --lts
npm install && npm run build

exec apache2-foreground
