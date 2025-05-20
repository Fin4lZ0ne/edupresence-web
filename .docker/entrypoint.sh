#!/bin/bash
set -e

chown -R www-data:www-data storage
if [ ! -d "vendor" ]; then
    composer install --no-interaction --optimize-autoloader
fi

php artisan key:generate

# Install Nodejs Deps
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.3/install.sh | bash

source ~/.bashrc
# export NVM_DIR="$HOME/.nvm"
# [ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"

nvm install --lts
npm install && npm run build

exec apache2-foreground
