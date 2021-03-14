<?php

Route::get('/restaurantmenu-dummy', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});