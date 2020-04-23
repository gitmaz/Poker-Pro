<?php

namespace Classes;
/**
 * Class CardSet This class encapsulates a set of cards functionalities. It is mainly responsible of generating a full set
 *  of cards (all suits) and keeping them as an array, Also it is responsible for shuffling and taking a sorted  hand
 *  set (5 cards)
 *
 * @package Classes
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class CardSet
{
    /**
     * @var array|null place where this class keeps the set of cards
     */
    private $cards = [];

    /**
     * @var bool if kept true, it will return higher value of Ace (14 instead of 1) and its neighborhood
     */
    private static $shouldReturnHighs = true;

    /**
     * @var array all possible ranks of a card
     */
    private $cardRanks = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];

    /**
     * @var array all possible suits
     */
    private $cardSuits = ["d", "h", "s", "c"];

    /**
     * CardSet constructor.It is basically responsible for generating a fresh set of cards (for all suits at once)
     *  but if an aray of cards are also passed, it will be uses as a separate set for sorting those cards only
     *
     * @param null $cards
     * @param bool $shouldReturnHighs
     */
    function __construct($cards = null, $shouldReturnHighs = false)
    {

        self::$shouldReturnHighs = $shouldReturnHighs;
        if ($cards == null) {
            for ($j = 0; $j < 4; $j++) {
                for ($i = 0; $i < 13; $i++) {

                    $thisCardRank = $this->cardRanks[$i];
                    $thisCardSuit = $this->cardSuits[$j];
                    $this->cards[] = new Card($i + 1, $thisCardRank, $thisCardSuit);
                }
            }
        } else {

            //first of all, quit if any supplied card name is malformed
            $this->isValidCardSet($cards);

            //if $cards is supplied, create a nice sorted card set from them
            $this->cards = $cards;
            $this->sortCards();
        }
    }

    /**
     * checks if the supplied cards match our naming convention (ie $rank.$suit) and have correct values, throws exception
     *  otherwise
     *
     * @param $cards
     */
    function isValidCardSet($cards)
    {
        foreach ($cards as $card) {
            $cardFaceName = $card->toString();
            $cardHasError = false;
            if (strlen($cardFaceName) > 3) {
                throw(new \Exception("$cardFaceName have more than three characters! Please fix and rerun."));
            }

            $rank = $card->getRank();
            if (!in_array($rank, $this->cardRanks)) {
                throw(new \Exception("$cardFaceName have misspelled rank! Please fix and rerun."));
            }

            $suit = $card->getSuit();
            if (!in_array($suit, $this->cardSuits)) {
                throw(new \Exception("$cardFaceName have misspelled suit! Please fix and rerun."));
            }
        }
    }

    /**
     * This will shuffle the whole set of cards and randomly take 5 out of them
     * @return array
     */
    function shuffleTakeFive()
    {

        $randCardIndexes = array_rand($this->cards, 5);
        $selectedCards = [];

        foreach ($randCardIndexes as $randCardIndex) {
            $selectedCards[] = $this->cards[$randCardIndex];
        }

        return $selectedCards;
    }


    /**
     * This is used to compare two cards ranks, depending if we are playing low or high, it will consider the lower (1)
     *  or higher (14) rank of Ace, ie higher than the king (if higher rank is considered, 2,3..4 also will have higher rank
     *  than king)
     *
     * @param $card1 object of type Card
     * @param $card2 object of type Card
     * @return int
     */
    static function compareCardsByValue($card1, $card2)
    {
        $card1Value = $card1->getValue(self::$shouldReturnHighs);
        $card2Value = $card2->getValue(self::$shouldReturnHighs);
        if ($card1Value == $card2Value) return 0;
        return (self::$shouldReturnHighs ? ($card1Value > $card2Value ? 1 : -1) : ($card1Value < $card2Value ? 1 : -1));
    }

    /**
     * This will sort the set acording to low or high rules using compareCardsByValue() utility function above
     */
    function sortCards()
    {
        usort($this->cards, "self::compareCardsByValue");
    }

    /**
     * This function will check if cards are adjacent based to low (ex: "Ad","2h","3c","4d","5s") or high rules
     *  (ex: "Js","Qh","Kd","Ad","2c"), it also fills $sameSuit as true if cards are of same suit (ex: "Ad","2d","3d","4d","5d")
     *
     * @param $sameSuit
     * @return bool
     */
    function areCardValuesAdjacentOrSameSuit(&$sameSuit)
    {

        $countCards = count($this->cards);
        $areAdjacent = true;

        foreach ($this->cards as $ind => $card) {

            if ($ind + 1 < $countCards) {
                $nextCard = $this->cards[$ind + 1];
                if ($sameSuit) {
                    if ($card->getSuit() != $nextCard->getSuit()) {
                        $sameSuit = false;
                    }
                }
                $m1 = $card->getValue(self::$shouldReturnHighs);
                $m2 = $nextCard->getValue(self::$shouldReturnHighs);
                if ((self::$shouldReturnHighs == 0) ? (($m1 - $m2) == 1) : (($m2 - $m1) == 1)) {
                    continue;
                } else {
                    $areAdjacent = false;
                    break;
                }
            }
        }


        return $areAdjacent;
    }


    /**
     * @return string returns a wel formatted string representation of internal cards array
     */
    function toString()
    {
        $handStr = "";
        foreach ($this->cards as $ind => $card) {
            $commaOrNothing = ($ind == 0 ? "" : ",");
            $handStr .= $commaOrNothing . ($card->toString());
        }
        return $handStr;
    }
}
