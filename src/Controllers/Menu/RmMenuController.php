<?php

namespace Anibalealvarezs\RestaurantMenu\Controllers\Menu;

use Anibalealvarezs\RestaurantMenu\Controllers\RmBuilderController;
use Anibalealvarezs\RestaurantMenu\Models\RmMenu;
use Anibalealvarezs\RestaurantMenu\Models\RmMenuSection;
use App\Http\Requests;
use Inertia\Response as InertiaResponse;

class RmMenuController extends RmBuilderController
{
    function __construct($crud_perms = false)
    {
        // Vars Override
        $this->key = 'Menu';
        $this->childKey = 'MenuSection';
        $this->grandchildKey = 'MenuItem';
        // Validation Rules
        $this->validationRules = [
            'name' => ['required', 'max:190'],
            'description' => [],
            'status' => ['required'],
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
        $model = $this->modelPath::with($this->childNames)->orderBy('name')->get();

        $this->shares[] = $this->childNames;

        return parent::index($model);
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
        $model = RmMenu::find($id);
        $childModels = ([]);
        if ($model) {
            $childModels = RmMenuSection::with([$this->grandchildNames, $this->name => function ($query) use ($id) {
                $query->where('id', $id);
            }])->where($this->name.'_id', $id)->orderBy('position')->orderBy('name')->get();
        }

        $this->shares[] = $this->grandchildNames;
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
}
