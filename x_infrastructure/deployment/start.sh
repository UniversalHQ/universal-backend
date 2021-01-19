#!/bin/sh

#refresh stored caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Migrate ApTestingData
php artisan migrate:fresh --seed --force
