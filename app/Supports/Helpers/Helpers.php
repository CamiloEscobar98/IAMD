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

    function current_user(): \App\Models\Client\User
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

if (!function_exists('current_role')) {


    function current_role(): \App\Models\Client\Role|Null
    {
        if ($role = session('current_role')) {
            return $role;
        } else {
            null;
        }
    }
}
