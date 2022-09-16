<?php

namespace App\Traits\Client\IntangibleAsset;

/**
 * 
 */
trait HasPhases
{
    /** Phases for Intangible Asset */

    /**
     * @return bool
     */
    public function hasPhaseOneCompleted(): bool
    {
        return !is_null($this->classification_id);
    }

    /**
     * @return bool
     */
    public function hasPhaseTwoCompleted(): bool
    {
        return !is_null($this->description);
    }

    /**
     * @return bool
     */
    public function hasPhaseThreeCompleted(): bool
    {
        return !is_null($this->intangible_asset_state_id);
    }

    /**
     * @return bool
     */
    public function hasPhaseFourCompleted(): bool
    {
        return !empty($this->dpis);
    }

    /**
     * @return bool
     */
    public function hasPhaseFiveCompleted(): bool
    {
        return false;
    }
}
