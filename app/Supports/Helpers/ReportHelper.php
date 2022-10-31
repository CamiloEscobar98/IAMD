<?php

if (!function_exists('hasContent')) {
    /**
     * @param array $items
     * @param string $value
     * 
     * @return bool
     */
    function hasContent(array $items, string $value): bool
    {
        return isset($items[$value]) ? $items[$value] : false;
    }
}

if (!function_exists('hasAnyContent')) {
    /**
     * @param array $items
     * @param array $values
     * 
     * @return bool
     */
    function hasAnyContent(array $items, array $values): bool
    {
        foreach ($values as $value) {
            if (!hasContent($items, $value)) {
                return false;
            }
        }
        return true;
    }
}
