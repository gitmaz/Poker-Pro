<?php

namespace Classes;

use Classes\iHandSelectionStrategy;
use Classes\Card;
use Classes\CardSet;

/**
 * * This is a strategy of faking a wrong card rank in a known set of hand cards:
 *  ("Ad","11s","3c","4h", "5s")
 *
 * Class WrongRankHandSelection
 * @package Classes
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class WrongRankHandSelection implements iHandSelectionStrategy
{
    public function getSample($shouldReturnHigh)
    {
        $_Ad = Card::createByName("Ad");
        $_11s = Card::createByName("11s");
        $_3c = Card::createByName("3c");
        $_4h = Card::createByName("4h");
        $_5s = Card::createByName("5s");

        $sampleStraightCards = [$_4h, $_3c, $_5s, $_11s, $_Ad];

        return new CardSet($sampleStraightCards, $shouldReturnHigh);
    }
}
