<?php

if (!function_exists('isSelectedOption')) {

    /**
     * @param array $options
     * @param string $key
     * @param mixed $value
     * 
     * @return bool
     */
    function isSelectedOption($options, $key, $value)
    {
        return isset($options[$key]) && $options[$key] == $value;
    }
}

if (!function_exists('twoOptionsIsEqual')) {
    /**
     * 
     */
    function twoOptionsIsEqual($option, $value)
    {
        return (isset($option) && isset($value)) && $option == $value ? 'selected' : '';
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
