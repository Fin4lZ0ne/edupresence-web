#!/bin/bash
set -e

if [ ! -d "vendor" ]; then
    composer install --no-interaction --optimize-autoloader
fi

php artisan key:generate

# Install Nodejs Deps
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.3/install.sh | bash
source ~/.bashrc
nvm install --lts
npm install && npm run build

exec apache2-foreground
