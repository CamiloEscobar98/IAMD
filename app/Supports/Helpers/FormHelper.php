<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

if (!function_exists('isSelectedOption')) {

    /**
     * @param array $options
     * @param string $key
     * @param mixed $value
     * 
     * @return bool
     */
    function isSelectedOption($options, $key, $value): bool
    {
        return isset($options[$key]) && $options[$key] == $value;
    }
}

if (!function_exists('twoOptionsIsEqual')) {
    /**
     * @param mixed $option
     * @param mixed $value
     * 
     * @return string|null
     */
    function twoOptionsIsEqual($option, $value): string|null
    {
        return (isset($option) && isset($value)) && $option == $value ? 'selected' : null;
    }
}

if (!function_exists('getParamValue')) {

    /**
     * @param array $params
     * @param string $key
     * 
     * @return mixed
     */
    function getParamValue($params, $key)
    {
        return isset($params[$key]) ? $params[$key] : '';
    }
}

if (!function_exists('isInvalidByError')) {

    /**
     * @param mixed $errors
     * @param string $key
     * 
     * @return string|null
     */
    function isInvalidByError($errors, $key): string|null
    {
        return $errors->has($key) ? 'is-invalid' : null;
    }
}

if (!function_exists('getParamObject')) {

    /**
     * @param mixed $object
     * @param string $key
     * @param bool $empty
     * 
     * @return string|null
     */
    function getParamObject($object, $key, $empty = false): string|null
    {
        $emptyValue = $empty ? 'No hay registro' : '';
        return !is_null($object) && $object->$key ? $object->$key : $emptyValue;
    }
}

if (!function_exists('getParamObjectLevelTwo')) {

    /**
     * @param mixed $object
     * @param string $key
     * @param bool $empty
     * 
     * @return string|null
     */
    function getParamObjectLevelTwo($object, $level2, $key, $empty = false): string|null
    {
        $emptyValue = $empty ? 'No hay registro' : '';

        return !is_null($object) && $object->$level2 && $object->$level2->$key ? $object->$level2->$key : $emptyValue;
    }
}

if (!function_exists('twoOptionsIsEqualIntoObject')) {

    /**
     * @param mixed $object
     * @param string $key
     * @param mixed $value
     * 
     * @return string|null
     */
    function twoOptionsIsEqualIntoObject($object, $key, $value): string|null
    {
        return (!is_null($object) && $object->$key) && $object->$key == $value ? 'selected' : null;
    }
}

if (!function_exists('transformDatetoString')) {

    /**
     * @param string $date
     * 
     * @return string
     */
    function transformDatetoString(string $date)
    {
        $format = Carbon::parse($date);
        $day = Str::ucfirst($format->dayName) . " {$format->day} de";
        $month = Str::ucfirst($format->monthName);
        return "{$day} {$month} del {$format->year}";
    }
}

if (!function_exists('transformTimestampToString')) {

    /**
     * @param string $date
     * 
     * @return string
     */
    function transformTimestampToString(string $date)
    {
        $format = Carbon::parse($date);
        $day = Str::ucfirst($format->dayName) . " {$format->day} de";
        $month = Str::ucfirst($format->monthName);
        return "{$day} {$month} del {$format->year}, {$format->format('g:i A')}";
    }
}
