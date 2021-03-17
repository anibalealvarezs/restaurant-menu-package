<?php

Route::get('/clear-cache-dummy', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
