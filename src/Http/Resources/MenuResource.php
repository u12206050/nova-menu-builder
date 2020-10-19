<?php

namespace Day4\MenuBuilder\Http\Resources;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Day4\MenuBuilder\BuilderResourceTool;
use Day4\MenuBuilder\Models\Menu;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;
use Day4\MenuBuilder\MenuBuilder;

class MenuResource extends Resource
{
    public static string $model = Menu::class;
    public static array $search = ['name', 'slug'];
    public static bool $displayInNavigation = false;

    public function fields(Request $request)
    {
        $fields = [
            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(__('Slug'), 'slug')
                ->sortable()
                ->creationRules('required', 'max:255', "unique:menus,slug,NULL,id,locale,{$request->get('locale')}")
                ->updateRules('required', 'max:255', "unique:menus,slug,{{resourceId}},id,locale,{$request->get('locale')}"),
        ];

        $fields[] = BuilderResourceTool::make()->withMeta(['locale' => app()->getLocale()]);
        return $fields;
    }

    public static function label()
    {
        return 'Menus';
    }

    public static function singularLabel()
    {
        return 'Menu';
    }

    public static function uriKey()
    {
        return 'nova-menu';
    }

    public function title()
    {
        return $this->name . ' (' . $this->slug . ')';
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('locale', app()->getLocale());
    }
}
