<?php

namespace Classes;

use Classes\iHandSelectionStrategy;
use Classes\CardSet;

/**
 * This is a strategy of selecting hands in a random fashion
 * Class RandomHandSelection
 *
 * @package Classes
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class RandomHandSelection implements iHandSelectionStrategy
{

    public function getSample($shouldReturnHigh)
    {
        $setOfAllCards = new CardSet();
        return new cardSet($setOfAllCards->shuffleTakeFive(), $shouldReturnHigh);
    }
}
