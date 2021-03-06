<?php

namespace Anibalealvarezs\RestaurantMenu\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class RmMenuItem extends RmBuilder
{
    use HasTranslations;

    protected $table = 'menu_item';

    public $translatable = ['name', 'description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_section_id', 'name', 'description', 'price', 'status', 'allow_duplicates', 'position'
    ];

    public function getNameAttribute($value)
    {
        if (json_decode($value)) {
            return json_decode($value)->{app()->getLocale()};
        }
        return $value;
    }

    public function getDescriptionAttribute($value)
    {
        if (json_decode($value)) {
            return json_decode($value)->{app()->getLocale()};
        }
        return $value;
    }

    /**
     * Get the menu that owns the dish.
     */
    public function menusection(): BelongsTo
    {
        return $this->belongsTo(RmMenuSection::class, 'menu_section_id', 'id')->with('menu');
    }
}
