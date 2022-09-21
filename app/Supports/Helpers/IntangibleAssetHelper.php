<?php

use Illuminate\Database\Eloquent\Collection;

if (!function_exists('phaseIsCompletedColor')) {

    /**
     * @param bool|null $phaseState
     * @return string|null
     */
    function phaseIsCompletedColor($phaseState): string|null
    {
        if (is_null($phaseState)) return 'bg-warning';

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
    function phaseIsCompletedOpen($phaseState, $not = null): string|null
    {
        return $phaseState || (!is_null($not) && !old($not)) ? null : 'show';
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
            return !$intangibleAsset->hasConfidencialityContract() && !old('has_confidenciality_contract') == '1' ? 'selected' : null;
        } else {
            return $intangibleAsset->hasConfidencialityContract() || old('has_confidenciality_contract') == '1' ? 'selected' : null;
        }
    }
}

if (!function_exists('intangibleAssetHasCreators')) {

    /**
     * @param Collection $intangibleAssetCreators
     * @param int $creator_id
     * 
     * @return string|null
     */
    function intangibleAssetHasCreators($intangibleAssetCreators, $creator_id): string | null
    {
        return $intangibleAssetCreators->contains('id', $creator_id) ? 'selected' : null;
    }
}

if (!function_exists('intangibleAssetHasSessionRightContract')) {

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param bool $not
     * 
     * @return string|null
     */
    function intangibleAssetHasSessionRightContract($intangibleAsset, bool $not = false): string | null
    {
        if ($not) {
            return !$intangibleAsset->hasSessionRightContract() && !old('has_session_right') == '1' ? 'selected' : null;
        } else {
            return $intangibleAsset->hasSessionRightContract() || old('has_session_right') == '1' ? 'selected' : null;
        }
    }
}


if (!function_exists('intangibleAssetHasContability')) {

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param bool $not
     * 
     * @return string|null
     */
    function intangibleAssetHasContability($intangibleAsset, bool $not = false): string | null
    {
        if ($not) {
            return !$intangibleAsset->hasContability() && !old('has_contability') == '1' ? 'selected' : null;
        } else {
            return $intangibleAsset->hasContability() || old('has_contability') == '1' ? 'selected' : null;
        }
    }
}
if (!function_exists('intangibleAssetHasProtectionAction')) {

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param bool $not
     * 
     * @return string|null
     */
    function intangibleAssetHasProtectionAction($intangibleAsset, bool $not = false): string | null
    {
        if ($not) {
            return !$intangibleAsset->hasProtectionAction() && !old('has_protection_action') == '1' ? 'selected' : null;
        } else {
            return $intangibleAsset->hasProtectionAction() || old('has_protection_action') == '1' ? 'selected' : null;
        }
    }
}
