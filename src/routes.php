<?php

use Anibalealvarezs\RestaurantMenu\Controllers\Menu\RmMenuController as MenuController;
use Anibalealvarezs\RestaurantMenu\Controllers\Menu\RmMenuItemController as MenuItemController;
use Anibalealvarezs\RestaurantMenu\Controllers\Menu\RmMenuSectionController as MenuSectionController;
use Anibalealvarezs\RestaurantMenu\Controllers\RmFrontController as FrontController;

Route::resource('menus', MenuController::class)->middleware(['web', 'auth'])->name('*', 'menus');
Route::resource('menusections', MenuSectionController::class)->middleware(['web', 'auth'])->name('*', 'menusections');
Route::resource('menuitems', MenuItemController::class)->middleware(['web', 'auth'])->name('*', 'menuitems');

Route::group(['middleware' => ['web', 'auth:sanctum', 'verified']], function () {
    Route::prefix('menusections')->group(function () {
        Route::post('/sort/{id}', [MenuSectionController::class, 'sort']);
    });
    Route::prefix('menuitems')->group(function () {
        Route::post('/sort/{id}', [MenuItemController::class, 'sort']);
    });
});

Route::get('/restmenu', [FrontController::class, 'index'])->middleware(['web']);
