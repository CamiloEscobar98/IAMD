<?php

use Illuminate\Database\Eloquent\Collection;

use Illuminate\Support\Facades\Auth;

if (!function_exists('optionInArrayIsChecked')) {

    function optionInArrayIsChecked(Collection $collection, $value)
    {
        return $collection->contains('id', $value) ? 'checked' : '';
    }
}

if (!function_exists('current_user')) {

    function current_user()
    {
        return auth('web')->user();
    }
}

if (!function_exists('current_admin')) {

    function current_admin()
    {
        return auth('admin')->user();
    }
}
