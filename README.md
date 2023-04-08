Demo Indian takeaway website with ordering online and admin backend for shop

For production (railway.app):
set APP_ENV=production
set DB_xxxx variables as per railway.app
set DB_CONNECTION=mysql
set email variables?

railway.app build command as a minimum should be: `php run optimize`
this can be in the settings or you can set a variable NIXPACKS_BUILD_CMD
  if you wanted to start from scratch you could add: `php run optimize && php artisan migrate --force`