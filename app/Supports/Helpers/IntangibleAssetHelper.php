<?php

use Illuminate\Database\Eloquent\Collection;

if (!function_exists('phaseIsCompletedColor')) {

    /**
     * @param bool|null $phaseState
     * @param bool $gradient
     * 
     * @return string|null
     */
    function phaseIsCompletedColor($phaseState, $gradient = false): string|null
    {
        $gradientText = $gradient ? 'gradient-' : '';
        if (is_null($phaseState)) return "bg-{$gradientText}warning";

        return $phaseState ? "bg-{$gradientText}success" : "bg-{$gradientText}danger";
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

if (!function_exists('intangibleAssetHasSecretProtection')) {

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param bool $not
     * 
     * @return string|null
     */
    function intangibleAssetHasSecretProtection($intangibleAsset, bool $not = false): string | null
    {
        if ($not) {
            return !$intangibleAsset->hasSecretProtectionMeasure() && !old('has_secret_protection') == '1' ? 'selected' : null;
        } else {
            return $intangibleAsset->hasSecretProtectionMeasure() || old('has_secret_protection') == '1' ? 'selected' : null;
        }
    }
}

if (!function_exists('intangibleAssetHasDpiPriorityTool')) {

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param bool $not
     * 
     * @return string|null
     */
    function intangibleAssetHasDpiPriorityTool($intangibleAsset, bool $not = false): string | null
    {
        if ($not) {
            return !$intangibleAsset->hasPriorityTools() && !old('has_priority_tools') == '1' ? 'selected' : null;
        } else {
            return $intangibleAsset->hasPriorityTools() || old('has_priority_tools') == '1' ? 'selected' : null;
        }
    }
}


if (!function_exists('intangibleAssetHasSecretProtectionMeasure')) {

    /**
     * @param Collection $secretProtectionMeasures
     * @param int $secretProtectionMeasure
     * 
     * @return string|null
     */
    function intangibleAssetHasSecretProtectionMeasure($secretProtectionMeasures, $secretProtectionMeasure): string | null
    {
        return $secretProtectionMeasures->contains('id', $secretProtectionMeasure) ? 'selected' : null;
    }
}

if (!function_exists('intangibleAssetHasPriorityTool')) {

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param int $dpi
     * @param int $tool
     * 
     * @return string|null
     */
    function intangibleAssetHasPriorityTool($intangibleAsset, $dpi, $tool): string | null
    {
        /** @var Collection */
        $intangibleAssetPriorityTools = $intangibleAsset->priority_tools;
        return $intangibleAssetPriorityTools->contains(function ($item) use ($dpi, $tool) {
            return $item->dpi_id == $dpi && $item->priority_tool_id == $tool;
        }) ? 'selected' : null;
    }
}

if (!function_exists('intangibleAssetHasStrategy')) {

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAssetStrategy $intangibleAssetStrategy
     * @param int $strategy
     * @param int $tool
     * 
     * @return bool
     */
    function intangibleAssetHasStrategy($intangibleAssetStrategy, $strategyCategory): bool
    {
        return $intangibleAssetStrategy->strategy_category_id == $strategyCategory;
    }
}

if (!function_exists('intangibleAssetHasStrategyByStrategyCategory')) {

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param int $tool
     * 
     * @return bool
     */
    function intangibleAssetHasStrategyByStrategyCategory($intangibleAsset, $strategyCategory): bool
    {
        /** @var Collection */
        $intangibleAssetPriorityTools = $intangibleAsset->strategies;
        return $intangibleAssetPriorityTools->contains('strategy_category_id', $strategyCategory);
    }
}


if (!function_exists('intangibleAssetIsCommercial')) {

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param bool $not
     * 
     * @return string|null
     */
    function intangibleAssetIsCommercial($intangibleAsset, bool $not = false): string | null
    {
        if ($not) {
            return !$intangibleAsset->isCommercial() && !old('is_commercial') == '1' ? 'selected' : null;
        } else {
            return $intangibleAsset->isCommercial() || old('is_commercial') == '1' ? 'selected' : null;
        }
    }
}

if (!function_exists('intangibleAssetHasStrategies')) {

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param bool $not
     * 
     * @return string|null
     */
    function intangibleAssetHasStrategies($intangibleAsset, bool $not = false): string | null
    {
        if ($not) {
            return !$intangibleAsset->hasStrategies() && !old('has_strategies') == '1' ? 'selected' : null;
        } else {
            return $intangibleAsset->hasStrategies() || old('has_strategies') == '1' ? 'selected' : null;
        }
    }
}


if (!function_exists('getIdsByCollection')) {

    /**
     * @param Collection $collection
     * @param string $key
     * 
     * @return array
     */
    function getIdsByCollection($collection, $key): array
    {
        $newArray = [];

        return $newArray;
    }
}

if (!function_exists('getStatusBarColor')) {
    /**
     * @param float $porcent
     * 
     * @return string
     */
    function getStatusBarColor(float $porcent)
    {
        switch ($porcent) {
            case $porcent < 50:
                return 'bg-gradient-danger';
                break;
            case $porcent > 50 && $porcent < 75:
                return 'bg-gradient-warning';
                break;

            default:
                return 'bg-gradient-success';
                break;
        }
    }
}

if (!function_exists('getPhasesByNumber')) {
    /**
     * @param array|string $phases
     * 
     * @return array|string
     */
    function getPhasesByNumber(array|string $phases, bool $asQuery = false): array|string
    {
        $phasesString = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'night'];

        if (is_array($phases)) {
            $arrayAux = [];
            foreach ($phases as $key => $phase) {
                if ($asQuery) {
                    $arrayAux["intangible_asset_phases.phase_{$phasesString[$phase - 1]}_completed"] = $phase; 
                } else {
                    array_push($arrayAux, "phase_{$phasesString[$phase - 1]}_completed");
                }
            }
            return $arrayAux;
        } else {
            return "phase_{$phasesString[$phases - 1]}_completed";
        }
    }
}
