<?php

namespace Anibalealvarezs\RestaurantMenu\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class RmMenuSection extends RmBuilder
{
    use HasTranslations;

    protected $table = 'menu_section';

    public $translatable = ['name', 'description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id', 'name', 'description', 'status', 'position'
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
    public function menu(): BelongsTo
    {
        return $this->belongsTo(RmMenu::class, 'menu_id', 'id');
    }

    /**
     * Get the items for the menu.
     */
    public function menuitems(): HasMany
    {
        return $this->hasMany(RmMenuItem::class, 'menu_section_id', 'id')->orderBy('position');
    }

    public function delete()
    {
        RmMenuItem::where('menu_section_id', $this->id)->delete();

        // delete the country
        return parent::delete();
    }
}
