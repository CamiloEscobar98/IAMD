<?php

use Illuminate\Database\Eloquent\Collection;

if (!function_exists('phaseIsCompletedColor')) {

    /**
     * @param bool $phaseState
     * @return string|null
     */
    function phaseIsCompletedColor($phaseState): string|null
    {
        return $phaseState ? 'bg-success' : 'bg-danger';
    }
}


if (!function_exists('phaseIsCompletedButton')) {

    /**
     * @param bool $phaseState
     * @return string|null
     */
    function phaseIsCompletedButton($phaseState): string|null
    {
        return $phaseState ? 'btn-outline-success' : 'btn-outline-danger';
    }
}

if (!function_exists('phaseIsCompletedOpen')) {

    /**
     * @param bool $phaseState
     * @return string|null
     */
    function phaseIsCompletedOpen($phaseState): string|null
    {
        return $phaseState ? null : 'show';
    }
}


if (!function_exists('phaseIsCompletedIcon')) {

    /**
     * @param bool $phaseState
     * 
     * @return string|null
     */
    function phaseIsCompletedIcon($phaseState)
    {
        return $phaseState ? 'fas fa-check' : 'fas fa-exclamation-circle';
    }
}


if (!function_exists('intangibleAssetHasDPI')) {

    /**
     * @param Collection $intangibleAssetDpis
     * @param int $dpi
     * 
     * @return string|null
     */
    function intangibleAssetHasDPI($intangibleAssetDpis, $dpi): string | null
    {
        return $intangibleAssetDpis->contains('dpi_id', $dpi) ? 'selected' : null;
    }
}
