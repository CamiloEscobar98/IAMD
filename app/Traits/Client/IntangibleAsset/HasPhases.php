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
        return $this->hasDpis();
    }

    /**
     * @return bool|null
     */
    public function hasPhaseFiveCompleted(): bool|null
    {
        $phasesMethods = ['hasConfidencialityContract', 'hasBeenPublished', 'hasCreators', 'hasSessionRightContract', 'hasContability'];

        $cont = 0;
        $i = 0;

        while ($i < count($phasesMethods)) {
            $method = $phasesMethods[$i];
            if ($this->$method()) {
                $cont++;
            }
            $i++;
        }

        if ($cont === 0) return false;

        return $cont === count($phasesMethods) ? true : null;
    }

    /**
     * @return bool
     */
    public function hasPhaseSixCompleted(): bool
    {
        return $this->hasMessages();
    }

    /** 
     * @return bool|null
     */
    public function hasPhaseSevenCompleted(): bool|null
    {
        $phasesMethods = ['hasProtectionAction', 'hasSecretProtectionMeasure'];

        $cont = 0;
        $i = 0;

        while ($i < count($phasesMethods)) {
            $method = $phasesMethods[$i];
            if ($this->$method()) {
                $cont++;
            }
            $i++;
        }

        if ($cont === 0) return false;

        return $cont === count($phasesMethods) ? true : null;
    }

    /**
     * @return bool
     */
    public function hasPhaseEightCompleted(): bool
    {
        return $this->hasPriorityTools();
    }
}
