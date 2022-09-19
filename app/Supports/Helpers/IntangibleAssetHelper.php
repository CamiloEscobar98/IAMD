<?php

use Illuminate\Database\Eloquent\Collection;

if (!function_exists('phaseIsCompletedColor')) {

    /**
     * @param bool|null $phaseState
     * @return string|null
     */
    function phaseIsCompletedColor($phaseState): string|null
    {
        if(is_null($phaseState)) return 'bg-warning';
        
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

if (!function_exists('intangibleAssetHasBeenPublished')) {

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param bool $not
     * 
     * @return string|null
     */
    function intangibleAssetHasBeenPublished($intangibleAsset, bool $not = false): string | null
    {
        if ($not) {
            return !$intangibleAsset->hasBeenPublished() ? 'selected' : null;
        } else {
            return $intangibleAsset->hasBeenPublished() ? 'selected' : null;
        }
    }
}

if (!function_exists('intangibleAssetHasConfidencialityContract')) {

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param bool $not
     * 
     * @return string|null
     */
    function intangibleAssetHasConfidencialityContract($intangibleAsset, bool $not = false): string | null
    {
        if ($not) {
            return !$intangibleAsset->hasConfidencialityContract() ? 'selected' : null;
        } else {
            return $intangibleAsset->hasConfidencialityContract() ? 'selected' : null;
        }
    }
}
