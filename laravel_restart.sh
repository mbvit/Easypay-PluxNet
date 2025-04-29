php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
# sudo systemctl restart php8.4-fpm
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan queue:restart