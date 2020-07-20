@php
use Day4\MenuBuilder\Http\Resources\MenuResource;
@endphp
@if (MenuResource::authorizedToViewAny(request()))
<router-link tag="h3" :to="{name: 'nova-menu'}"
    class="cursor-pointer flex items-center font-normal dim text-white mb-6 text-base no-underline">
    <svg class="sidebar-icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="1" y="1" width="18" height="4" rx="2" stroke="currentColor" stroke-width="2"/>
        <rect x="1" y="8" width="18" height="4" rx="2" stroke="currentColor" stroke-width="2"/>
        <rect x="1" y="15" width="18" height="4" rx="2" stroke="currentColor" stroke-width="2"/>
    </svg>

    <span class="sidebar-label">
        {{ __('Menus') }}
    </span>
</router-link>
@endif
