#!/bin/sh

# Exit immediately if a command exits with a non-zero status.
set -e

#refresh stored caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

#Cache the config
#php artisan config:cache

cron

# Execute CMD
exec "$@"
