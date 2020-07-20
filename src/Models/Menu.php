<?php

namespace Day4\MenuBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Day4\MenuBuilder\MenuBuilder;

class Menu extends Model
{
    public static function boot() {
        parent::boot();
        self::creating(function ($menu) {
            $menu->locale = app()->getLocale();
        });
    }

    public function rootMenuItems()
    {
        return $this->hasMany(MenuItem::class)
            ->where('parent_id', null)
            ->orderBy('parent_id')
            ->orderBy('order')
            ->orderBy('name');
    }

    public function formatForAPI()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'menuItems' => collect($this->rootMenuItems)->map(function ($item) {
                return $this->formatMenuItem($item);
            }),
        ];
    }

    public function formatMenuItem($menuItem)
    {
        return [
            'id' => $menuItem->id,
            'name' => $menuItem->name,
            'type' => $menuItem->type,
            'value' => $menuItem->customValue,
            'target' => $menuItem->target,
            'parameters' => $menuItem->parameters,
            'enabled' => $menuItem->enabled,
            'children' => empty($menuItem->children) ? [] : $menuItem->children->map(function ($item) {
                return $this->formatMenuItem($item);
            }),
        ];
    }

    /**
     * Scope a query to only include current language menu
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLocale($query)
    {
        return $query->where('locale', app()->getLocale());
    }
}
