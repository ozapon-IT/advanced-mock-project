#!/bin/sh
set -e

echo "Waiting for database connection..."
/usr/local/bin/wait-for-it.sh mysql:3306 --timeout=30 --strict -- echo "Database is up"

echo "Running migrations and seeding..."
php artisan migrate --seed --force

echo "Starting Supervisor..."
exec supervisord -c /etc/supervisor/conf.d/supervisor.conf