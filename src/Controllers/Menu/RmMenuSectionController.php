<?php

namespace Anibalealvarezs\RestaurantMenu\Controllers\Menu;

use Anibalealvarezs\Projectbuilder\Models\PbRoles;
use Anibalealvarezs\RestaurantMenu\Controllers\RmBuilderController;
use Anibalealvarezs\RestaurantMenu\Models\RmMenu;
use Anibalealvarezs\RestaurantMenu\Models\RmMenuItem;
use Anibalealvarezs\RestaurantMenu\Models\RmMenuSection;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response as InertiaResponse;

class RmMenuSectionController extends RmBuilderController
{
    function __construct($crud_perms = false)
    {
        // Vars Override
        $this->key = 'MenuSection';
        $this->parentKey = 'Menu';
        $this->childKey = 'MenuItem';
        // Validation Rules
        $this->validationRules = [
            'name' => ['required', 'max:190'],
            'description' => [],
            'menu' => ['required'],
            'status' => ['required'],
        ];
        // Model fields name replacing
        $this->replacers = [
            'menu' => 'menu_id'
        ];
        // Sortable model ?
        $this->sortable = true;
        // Sortable model
        $this->sortingRef = 'menu_id';
        // Show ID column ?
        $this->showId = false;
        // Default values
        $this->defaults = [
            'status' => 1,
        ];
        // Parent construct
        parent::__construct(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @param null $element
     * @param bool $multiple
     * @param string $route
     * @return void
     */
    public function index($element = null, bool $multiple = false, string $route = 'level')
    {
        return Redirect::back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $route
     * @return InertiaResponse
     */
    public function create(string $route = 'level'): InertiaResponse
    {
        $this->shares[] = $this->names;
        $this->shares[] = $this->grandchildNames;

        return parent::create();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param null $element
     * @param bool $multiple
     * @param string $route
     * @return InertiaResponse
     */
    public function show(int $id, $element = null, bool $multiple = false, string $route = 'level'): InertiaResponse
    {
        $model = RmMenuSection::with('menu')->find($id);
        $childModels = ([]);
        if ($model) {
            $childModels = RmMenuItem::with(['menusection' => function ($query) use ($id) {
                $query->with('menu')->where('id', $id);
            }])->where('menu_section_id', $id)->orderBy('position')->orderBy('name')->get();
        }

        $this->shares[] = $this->names;

        $this->allowed = [
            'create '.$this->childNames => 'create',
            'update '.$this->childNames => 'update',
            'delete '.$this->childNames => 'delete',
        ];

        return parent::index(
            [
                'level' => [
                    'size' => 'single',
                    'object' => $model
                ],
                'child' => [
                    'size' => 'multiple',
                    'object' => $childModels
                ]
            ],
            true,
            'child'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param null $element
     * @param bool $multiple
     * @param string $route
     * @return InertiaResponse
     */
    public function edit(int $id, $element = null, bool $multiple = false, string $route = 'level'): InertiaResponse
    {
        $model = RmMenuSection::with(['menuitems', 'menu'])->find($id);
        $parentModel = ([]);
        if ($model) {
            $parentModel = RmMenu::find($model->menu->id);
        }

        $this->shares[] = $this->childNames;
        $this->shares[] = $this->parentNames;

        $this->allowed = [
            'create '.$this->names => 'create',
            'update '.$this->names => 'update',
            'delete '.$this->names => 'delete',
        ];

        return parent::edit(
            $id,
            [
                'level' => [
                    'size' => 'single',
                    'object' => $model
                ],
                'parent' => [
                    'size' => 'single',
                    'object' => $parentModel
                ]
            ],
            true
        );
    }
}
