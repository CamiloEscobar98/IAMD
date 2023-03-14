<?php

if (!function_exists('hasContent')) {
    /**
     * @param array<string,string> $items
     * @param string $value
     * 
     * @return bool
     */
    function hasContent($items, string $value): bool
    {
        return isset($items[$value]) ;
    }
}

if (!function_exists('hasAnyContent')) {
    /**
     * @param array<string,string> $items
     * @param array<string,string> $values
     * 
     * @return bool
     */
    function hasAnyContent($items,  $values): bool
    {
        foreach ($values as $value) {
            if (hasContent($items, $value)) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('hasGraphics')) {
    /**
     * @param array<string,string> $items
     * 
     * @return bool
     */
    function hasGraphics(array $items): bool
    {
        $values = [
            'with_graphics_assets_per_year', 'with_graphics_assets_classification_per_year', 'with_graphics_default'
        ];

        foreach ($values as $value) {
            if (hasContent($items, $value)) {
                return true;
            }
        }
        return false;
    }
}
