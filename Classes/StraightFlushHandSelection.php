<?php

namespace Classes;

use Classes\iHandSelectionStrategy;
use Classes\Card;
use Classes\CardSet;

/**
 * * This is a strategy of selecting a known sample straight flush hand ie: ("Ad","2d","3d","4d", "5d")
 *
 * Class StraightFlushHandSelection
 * @package Classes
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class StraightFlushHandSelection implements iHandSelectionStrategy
{
    public function getSample($shouldReturnHigh)
    {
        $_Ad = Card::createByName("Ad");
        $_2d = Card::createByName("2d");
        $_3d = Card::createByName("3d");
        $_4d = Card::createByName("4d");
        $_5d = Card::createByName("5d");

        $sampleStraightFlushCards = [$_4d, $_3d, $_5d, $_2d, $_Ad];

        return new CardSet($sampleStraightFlushCards, $shouldReturnHigh);
    }
}
