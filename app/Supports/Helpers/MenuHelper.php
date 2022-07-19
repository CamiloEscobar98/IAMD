<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

if (!function_exists('routeIsActived')) {

    /**
     * Get if route is actived.
     * 
     * @param string $resource
     * 
     * @return string
     */
    function routeIsActived($resource): string
    {
        $currentURL = URL::current();

        $array = explode('/', $currentURL);

        return in_array($resource, $array) ? 'active' : '';
    }
}

if (!function_exists('dropdownIsActived')) {
    /**
     * Get if the dropdown has be opened.
     * 
     * @param string $resource
     * 
     * @return string
     */
    function dropdownIsActived($resource) : string 
    {
        $currentURL = URL::current();

        $array = explode('/', $currentURL);

        return in_array($resource, $array) ? 'menu-is-opening menu-open' : ''; 
    }
}