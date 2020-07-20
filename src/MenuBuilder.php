<?php

namespace Day4\MenuBuilder;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class MenuBuilder extends Tool
{
    protected static $defaultLinkableModels = [
        \Day4\MenuBuilder\Classes\MenuItemStaticURL::class,
        \Day4\MenuBuilder\Classes\MenuItemText::class,
    ];

    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-menu', __DIR__ . '/../dist/js/tool.js');
        Nova::style('nova-menu', __DIR__ . '/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('nova-menu::navigation');
    }

    public static function getModels()
    {
        $configuredLinkableModels = config('nova-menu.linkable_models', []);
        return array_merge(
            static::$defaultLinkableModels,
            $configuredLinkableModels
        );
    }
}
