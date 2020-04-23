<?php
/*
 * This application is a demo of writing an application in oop using SOLID principals and Strategy Design Pattern
 *  It can pick a random set of playing cards hand an check whether they are "Straight" or "Straight Flush" according to Poker
 *  high low standard rules
 *
 * note: to run, type: php Play.php on the console and then press enter
 * to test with arbitrary set of hands, just write a new strategy similar to StraightHandSelection.php to see if
 * the application really works (you need to then add this at the end of $strategies array below.
 *
 * Alternatively pay attention to the random selection of cards appearing on the first line of output when running this
 * app and check the results logically
 *
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */

namespace Classes;
require_once __DIR__ . "/vendor/autoload.php";

use Classes\iHandSelectionStrategy;
use Classes\Player;

$strategies=[ /*"WrongRank", "MisspelledSuit",*/ "Random", "Straight", "StraightFlush", "StraightAceInTheMiddle"];

echo "\n\nPoker-Pro: Automatic Straight hand detection!\n\n\nNow Checking multiple scenarios:\n-----------------------------------\n";
try {
    foreach ($strategies as $strategy) {
        $handSelectionStrategyClassName = "Classes\\{$strategy}HandSelection";
        $handSelectionStrategy = new $handSelectionStrategyClassName();
        Player::checkIfHandIsStraightOrFlush($handSelectionStrategy);
        echo "\n-----------------------------------\n";
    }
}catch(\Exception $ex){
    echo "Error encountered while parsing input: \n". $ex->getMessage();
}
