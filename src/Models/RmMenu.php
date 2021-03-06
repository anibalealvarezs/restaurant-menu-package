<?php

namespace Anibalealvarezs\RestaurantMenu\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class RmMenu extends RmBuilder
{
    use HasTranslations;

    protected $table = 'menu';

    public $translatable = ['name', 'description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'status'
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
     * Get the items for the menu.
     */
    public function menusections(): HasMany
    {
        return $this->hasMany(RmMenuSection::class, 'menu_id', 'id')->with('menuitems')->orderBy('position');
    }

    public function delete()
    {
        RmMenuSection::where('menu_id', $this->id)->delete();

        // delete the country
        return parent::delete();
    }
}
