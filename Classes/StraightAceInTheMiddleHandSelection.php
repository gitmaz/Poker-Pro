<?php

namespace Classes;

use Classes\iHandSelectionStrategy;
use Classes\Card;
use Classes\CardSet;

/**
 * This is a strategy of selecting a known sample straight hand which have ace in the middle: ie:
 *  ("Ks","Ah","2s","3d", "4h")
 *
 * Class StraightAceInTheMiddleHandSelection
 * @package Classes
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class StraightAceInTheMiddleHandSelection implements iHandSelectionStrategy
{
    public function getSample($shouldReturnHigh)
    {
        $_Ks = Card::createByName("Ks");
        $_Ah = Card::createByName("Ah");
        $_2s = Card::createByName("2s");
        $_3d = Card::createByName("3d");
        $_4h = Card::createByName("4h");

        $sampleStraightAceInMiddleCards = [$_3d, $_Ks, $_4h, $_Ah, $_2s];

        return new CardSet($sampleStraightAceInMiddleCards, $shouldReturnHigh);
    }
}
