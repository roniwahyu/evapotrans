<?php
/**
 * This file is part of dispositif/evapotrans library
 * 2014-2019 (c) Philippe M. <dispositif@gmail.com>
 * For the full copyright and license information, please view the LICENSE file.
 */

namespace Evapotrans\ValueObjects;

// Rather a "power" measurement but using the domain word
class Energy extends AbstractMeasure
{
    const UNIT = 'MJ.m-2.day-1';

    /**
     * latent heat of vaporization (l)
     * Simplified as constant (at 20°C) (Reference: Harrison 1963)
     * l = 2.501 - (2.361 x 10-3) x Temp.
     */
    const LATENT_HEAT_VAPORIZATION = 2.45;

    /**
     * Conversion from energy values to equivalent evaporation
     * equivalent evaporation from Eq. [20]
     * by using a conversion factor equal to the inverse of the latent heat of
     * water vaporization value : MJ.m-2.day-1.
     *
     * @return float mm/day
     */
    public function equivalentEvaporation(): float
    {
        return round(
            1 / self::LATENT_HEAT_VAPORIZATION * $this->getValue(),
            1
        );
    }

    /**
     * MJ.m-2.day-1 to W.m-2.
     *
     * @return float
     */
    public function convertWm2(): float
    {
        return round(11.6 * $this->getValue(), 1);
    }
}
