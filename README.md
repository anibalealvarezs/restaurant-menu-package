# Project Builder

### Instructions for installation:

#### 1. Add the following lines to composer.json:
```
"repositories":[
    {"type": "composer", "url": "https://repo.packagist.com/anibal-alvarez/"},
    {"packagist.org": false}
],
```

#### 2. If not installed, let's requiere jetstream and install livewire
```
composer require laravel/jetstream
php artisan jetstream:install livewire
```

#### 3. Require the package
```
composer require anibalealvarezs/restaurant-menu-package --no-cache
```

#### 5. Clear config cache
```
php artisan config:clear
```

#### 6. Migrate the DB
```
php artisan migrate
```
or, in case of migration failure (NOT FOR RUNNING PROJECTS SINCE DB WILL BE WIPED OUT),
```
php artisan migrate:refresh --seeds
```

#### 6. Publish Project Builder's Seeders
```

```

#### 7. Add "rmstorage" link to "app/filesystems.php"
```
'links' => [
        public_path('pbstorage') => app_path('vendor/anibalealvarezs/restaurant-menu-package/src/assets'),
    ],
```

#### 8. Create default "rmstorage" links
```
php artisan storage:link
```
if "rmstorage" links show error, navigate to "public folder", manually delete the link, and create a new one with the following command:
```
ln -s ../vendor/anibalealvarezs/restaurant-menu-package/src/assets rmstorage
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