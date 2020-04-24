<?php

namespace Classes;

use Classes\iHandSelectionStrategy;
use Classes\Card;
use Classes\CardSet;

/**
 * * This is a strategy of faking a misspelled card suit (x instead of c) in a known set of hand cards:
 *  ("Ad","2s","3x","4h", "5s")
 *
 * Class MisspelledSuitHandSelection
 * @package Classes
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class MisspelledSuitHandSelection implements iHandSelectionStrategy
{
    public function getSample($shouldReturnHigh)
    {
        $_Ad = Card::createByName("Ad");
        $_2s = Card::createByName("2s");
        $_3x = Card::createByName("3x");
        $_4h = Card::createByName("4h");
        $_5s = Card::createByName("5s");

        $sampleStraightCards = [$_4h, $_3x, $_5s, $_2s, $_Ad];

        return new CardSet($sampleStraightCards, $shouldReturnHigh);
    }
}
