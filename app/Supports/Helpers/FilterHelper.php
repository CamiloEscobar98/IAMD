<?php

use Illuminate\Support\Carbon;

if (!function_exists('set_sub_month_date_filter')) {
    /**
     * @param array $array
     * @param string $key
     * @param int $subMonth
     * @return array
     */
    function set_sub_month_date_filter($array, $key, $subMonth = 0)
    {

        if (!isset($array[$key])) {
            $array[$key] = Carbon::now()->subMonth($subMonth)->toDateString();
        }

        return $array;
    }
}

if (!function_exists('optionIsSelected')) {
    /**
     * @param array $options
     * @param mixed $option
     * @param mixed $value
     * 
     * @return string
     * 
     */
    function optionIsSelected($options, $option, $value)
    {
        return isset($options[$option]) && $options[$option] == $value ? 'selected' : '';
    }
}

if (!function_exists('optionInArray')) {
    /**
     * @param array $options
     * @param string $option
     * @param mixed $value
     * 
     * @return string
     * 
     */
    function optionInArray($options, $option, $value)
    {
        return isset($options[$option]) && in_array($value, $options[$option]) ? 'selected' : '';
    }
}
