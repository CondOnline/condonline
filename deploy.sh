# Change to the project directory
cd /var/www

# Turn on maintenance mode
php /var/www/artisan down

# Pull the latest changes from the git repository
# git reset --hard
# git clean -df
git pull origin master

# Install/update composer dependecies
composer.phar install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Run database migrations
php /var/www/artisan migrate --force

# Clear caches
php /var/www/artisan cache:clear

# Clear expired password reset tokens
php /var/www/artisan auth:clear-resets

# Clear and cache routes
php /var/www/artisan route:cache

# Clear and cache config
php /var/www/artisan config:cache

# Clear and cache views
php /var/www/artisan view:cache

# Install node modules
# npm ci

# Build assets using Laravel Mix
# npm run production

#restart queues
php /var/www/artisan queue:restart

# Turn off maintenance mode
php /var/www/artisan up
