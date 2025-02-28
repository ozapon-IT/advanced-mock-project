#!/bin/sh
set -e

echo "Checking for composer dependencies..."
if [ ! -d "vendor" ]; then
    echo "Vendor directory not found. Running composer install..."
    composer install
else
    echo "Vendor directory exists. Skipping composer install."
fi

echo "Setting up .env file..."
if [ ! -f ".env" ]; then
    cp .env.development.example .env
    php artisan key:generate
fi

echo "Creating storage symbolic link..."
php artisan storage:link

echo "Waiting for database connection..."
/usr/local/bin/wait-for-it.sh mysql:3306 --timeout=30 --strict -- echo "Database is up"

echo "Running migrations and seeding..."
php artisan migrate --seed --force

echo "Starting Supervisor..."
exec supervisord -c /etc/supervisor/conf.d/supervisor.conf