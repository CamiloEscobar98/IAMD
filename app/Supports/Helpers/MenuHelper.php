<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

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
    function dropdownIsActived($resource): string
    {
        $currentURL = URL::current();

        $array = explode('/', $currentURL);

        return in_array($resource, $array) ? 'menu-is-opening menu-open' : '';
    }
}

if (!function_exists('getClientRoute')) {
    /**
     * Get the route for Clients
     * 
     * @param string $route
     * @param array $params
     * 
     * @return string
     */

    function getClientRoute($route, $params = [])
    {
        $aux = [];

        array_push($aux, request('client'));

        $params = array_merge($aux, $params);

        return route($route, $params);
    }
}
