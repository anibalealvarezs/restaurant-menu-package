<?php

namespace Anibalealvarezs\RestaurantMenu\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class RmMenuItem extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];

    protected $table = 'menu_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id', 'name', 'description', 'price', 'status', 'allow_duplicates'
    ];

    /**
     * Get the menu that owns the dish.
     */
    public function menu()
    {
        return $this->belongsTo(RmMenu::class, 'menu_id');
    }
}
