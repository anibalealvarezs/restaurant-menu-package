<?php

namespace Anibalealvarezs\RestaurantMenu\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class RmMenu extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $table = 'menus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get the items for the menu.
     */
    public function items()
    {
        return $this->hasMany(RmMenuItem::class, 'menu_id');
    }
}
