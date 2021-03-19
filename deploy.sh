# Change to the project directory
#cd /var/www

# Turn on maintenance mode
php artisan down

# Pull the latest changes from the git repository
# git reset --hard
# git clean -df
git pull origin master

# Install/update composer dependecies
composer.phar install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Run database migrations
php artisan migrate --force

# Clear caches
php artisan cache:clear

# Clear expired password reset tokens
php artisan auth:clear-resets

# Clear and cache config
php artisan config:cache

# Clear and cache routes
php artisan route:cache

# Clear and cache views
php artisan view:cache

# Install node modules
# npm ci

# Build assets using Laravel Mix
# npm run production

#restart queues
php artisan queue:restart

# Turn off maintenance mode
php artisan up
