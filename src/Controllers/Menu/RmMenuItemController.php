<?php

namespace Anibalealvarezs\RestaurantMenu\Controllers\Menu;

use Anibalealvarezs\RestaurantMenu\Controllers\RmBuilderController;
use Anibalealvarezs\RestaurantMenu\Models\RmMenuItem;
use Anibalealvarezs\RestaurantMenu\Models\RmMenuSection;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response as InertiaResponse;

class RmMenuItemController extends RmBuilderController
{
    function __construct($crud_perms = false)
    {
        // Vars Override
        $this->key = 'MenuItem';
        $this->parentKey = 'MenuSection';
        // Parent construct
        parent::__construct(true);
        // Validation Rules
        $this->validationRules = [
            'name' => ['required', 'max:190'],
            'menusection' => ['required'],
            'description' => [],
            'status' => ['required'],
            'price' => [],
        ];
        // Model fields name replacing
        $this->replacers = [
            'menusection' => 'menu_section_id'
        ];
        // Sortable model ?
        $this->sortable = true;
        // Sortable model
        $this->sortingRef = 'menu_section_id';
        // Show ID column ?
        $this->showId = false;
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
        $this->shares[] = $this->parentNames;

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
        $this->shares[] = $this->names;

        return parent::show($id);
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
        $model = RmMenuItem::with(['menusection'])->find($id);
        $parentModel = ([]);
        if ($model) {
            $parentModel = RmMenuSection::find($model->menusection->id);
        }

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
                ],
            ],
            true,
        );
    }
}
