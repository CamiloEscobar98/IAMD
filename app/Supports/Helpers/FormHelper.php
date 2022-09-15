<?php

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
