# Restaurant Menu

### Instructions for installation:

#### 0. Pre-installation check:

If [Project Builder](https://github.com/anibalealvarezs/projectbuilder-package) ***WASN'T*** installed previously, go to that repository and follow the installation process before continuing

#### 1. Require the package
```
composer require anibalealvarezs/restaurant-menu-package --no-cache
```

#### 2. Clear config cache
```
php artisan config:clear
```

#### 3. Migrate the DB
```
php artisan migrate
php artisan db:seed --class=\\Anibalealvarezs\\RestaurantMenu\\Database\\Seeders\\RmMainSeeder
```

#### 4. OPTIONALLY, seed the DB step by step
These are the default seeders in case you want to run them manually
```
php artisan db:seed --class="Anibalealvarezs\RestaurantMenu\Database\Seeders\RmConfigSeeder"
php artisan db:seed --class="Anibalealvarezs\RestaurantMenu\Database\Seeders\RmMenuSeeder"
php artisan db:seed --class="Anibalealvarezs\RestaurantMenu\Database\Seeders\RmMenuItemSeeder"
php artisan db:seed --class="Anibalealvarezs\RestaurantMenu\Database\Seeders\RmPermissionsSeeder"
php artisan db:seed --class="Anibalealvarezs\RestaurantMenu\Database\Seeders\RmTeamSeeder"
php artisan db:seed --class="Anibalealvarezs\RestaurantMenu\Database\Seeders\RmNavigationSeeder"
```

### 5. Publish Vue components and libraries
Publish all necessary files
```
php artisan vendor:publish --provider="Anibalealvarezs\RestaurantMenu\Providers\RmViewServiceProvider" --tag="restmenu-views" --force
```
or publish them one by one
```
php artisan vendor:publish --provider="Anibalealvarezs\RestaurantMenu\Providers\RmViewServiceProvider" --tag="restmenu-components" --force
php artisan vendor:publish --provider="Anibalealvarezs\RestaurantMenu\Providers\RmViewServiceProvider" --tag="restmenu-js" --force
php artisan vendor:publish --provider="Anibalealvarezs\RestaurantMenu\Providers\RmViewServiceProvider" --tag="restmenu-css" --force
php artisan vendor:publish --provider="Anibalealvarezs\RestaurantMenu\Providers\RmViewServiceProvider" --tag="restmenu-blade" --force
php artisan vendor:publish --provider="Anibalealvarezs\RestaurantMenu\Providers\RmViewServiceProvider" --tag="restmenu-core" --force
```

### 6. Add resources to /webpack.mix.js
```

```

### 7. Install new resources as dependencies
```

```

### 8. Recompile app.js
For production:
```
npm run prod
```
For developing:
```
npm run watch
```

### Useful Commands:

```
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear
php artisan view:cache

php artisan clear-compiled
composer dump-autoload
php artisan optimize
```

### Developing Suite

Clone the <a href="https://github.com/anibalealvarezs/restmenu-dev">RestMenuDev repository</a> in order to continue this package developing
