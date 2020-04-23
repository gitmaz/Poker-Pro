<?php

namespace Classes;

use Classes\iHandSelectionStrategy;

/**
 * Class Player  This class is responsible for playing cards by checking if chosen set of hand is Straight or Straight flush
 *  ie cards of a hand are sequential and adjacent and wether or not they fall into same suit.
 *
 *  This is used as a manager design  pattern and by itself it does not do this job, it only coordinates between hand selection
 *  strategies and card set organiser objects which are delegated to do this job.
 *
 * @package Classes
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class Player
{

    /**
     * @param $handSelectionStrategy an interface of type iHandSelectionStrategy
     */
    static function checkIfHandIsStraightOrFlush($handSelectionStrategy)
    {

        for ($shouldReturnHigh = 0; $shouldReturnHigh <= 1; $shouldReturnHigh++) {
            $hand = $handSelectionStrategy->getSample($shouldReturnHigh);
            $sameSuit = true;
            $complies = $hand->areCardValuesAdjacentOrSameSuit($sameSuit);
            $flushPhrase = $sameSuit ? " Flush!!" : "";
            if ($complies) {
                echo "Cards at hand is: " . $hand->toString() . "\n\n";
                echo "Cards at hand is Straight{$flushPhrase}!";
                break;
            } else {
                if (!$shouldReturnHigh) {
                    continue;
                }
                echo "Cards at hand is: " . $hand->toString() . "\n\n";
                echo "Cards at hand is not Straight.";
            }
        }
    }

}
