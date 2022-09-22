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
        return $this->intangible_asset_phases->phase_one_completed;
    }

    /**
     * @return bool
     */
    public function hasPhaseTwoCompleted(): bool
    {
        return $this->intangible_asset_phases->phase_two_completed;
    }

    /**
     * @return bool
     */
    public function hasPhaseThreeCompleted(): bool
    {
        return $this->intangible_asset_phases->phase_three_completed;
    }

    /**
     * @return bool
     */
    public function hasPhaseFourCompleted(): bool
    {
        return $this->intangible_asset_phases->phase_four_completed;
    }

    /**
     * @return bool|null
     */
    public function hasPhaseFiveCompleted(): bool|null
    {
        return $this->intangible_asset_phases->phase_five_completed;
    }

    /**
     * @return bool
     */
    public function hasPhaseSixCompleted(): bool
    {
        return $this->intangible_asset_phases->phase_six_completed;
    }

    /** 
     * @return bool|null
     */
    public function hasPhaseSevenCompleted(): bool|null
    {
        return $this->intangible_asset_phases->phase_seven_completed;
    }

    /**
     * @return bool
     */
    public function hasPhaseEightCompleted(): bool
    {
        return $this->intangible_asset_phases->phase_eight_completed;
    }

    /**
     * @return bool
     */
    public function hasPhaseNineCompleted(): bool
    {
        return $this->intangible_asset_phases->phase_nine_completed;

    }
}
