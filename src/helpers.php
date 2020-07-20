<?php

use Day4\MenuBuilder\MenuBuilder;
use Day4\MenuBuilder\Models\Menu;

if (!function_exists('nova_get_menus')) {
    function nova_get_menus()
    {
        return Menu::all()
            ->load('rootMenuItems')
            ->map(function ($menu) {
                return $menu->formatForAPI();
            });
    }
}

if (!function_exists('nova_get_menu')) {
    function nova_get_menu($slug)
    {
        $menu = Menu::where('slug', $slug)->where('locale', app()->getLocale())->get()->first();
        return !empty($menu) ? $menu->formatForAPI() : null;
    }
}
