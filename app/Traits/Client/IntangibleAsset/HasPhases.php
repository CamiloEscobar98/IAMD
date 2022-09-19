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
     * @return bool|null
     */
    public function hasPhaseFiveCompleted(): bool|null
    {
        $phasesMethods = ['hasConfidencialityContract', 'hasBeenPublished'];

        $cont = 0;
        $i = 0;

        while ($cont < count($phasesMethods)) {
            $method = $phasesMethods[$i];
            if (!$this->$method()) {
                $cont++;
            } else {
                return null;
            }
            $i++;
        }

        return $cont == count($phasesMethods);
    }
}
