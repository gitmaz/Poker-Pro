<?php

namespace Classes;

use Classes\iHandSelectionStrategy;
use Classes\Card;
use Classes\CardSet;

/**
 * * This is a strategy of selecting a known sample straight hand which does not have ace in the middle: ie:
 *  ("Ad","2s","3c","4h", "5s")
 *
 * Class StraightHandSelection
 * @package Classes
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class StraightHandSelection implements iHandSelectionStrategy
{
    public function getSample($shouldReturnHigh)
    {
        $_Ad = Card::createByName("Ad");
        $_2s = Card::createByName("2s");
        $_3c = Card::createByName("3c");
        $_4h = Card::createByName("4h");
        $_5s = Card::createByName("5s");

        $sampleStraightCards = [$_4h, $_3c, $_5s, $_2s, $_Ad];

        return new CardSet($sampleStraightCards, $shouldReturnHigh);
    }
}
