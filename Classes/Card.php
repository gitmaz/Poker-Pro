<?php

namespace Classes;

/**
 * Class Card  This class encapsulates an individual card's functionalities
 * @package Classes
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class Card
{

    private $value;
    private $rank;
    private $suit;

    /**
     * creates a card of rank $rank from suit $suit and keeps its relative index of this card compared to other cards of same suit.
     *  this value is a sequential number starting from 1 (for Ace)
     *
     * @param $value integer
     * @param $rank  string
     * @param $suit  string
     */
    function __construct($value, $rank, $suit)
    {
        $this->value = $value;
        $this->rank = $rank;
        $this->suit = $suit;
    }

    /**
     * return the well formatted face name of the card such as "As" (Ace of Spades) or "10h" (10 of harts)
     */
    function toString()
    {
        return $this->rank . $this->suit;
    }

    /**
     * returns the sequential index of this card in the same suit
     *
     * @param bool $shouldReturnHighs if put as true, it will consider Ace to have a rank > King (K) which means a rank
     *   of 14(1+13) and 2 to 4 as 15(2+13) to 17(4+13) to be considered in a high hand set such a ("Qs", "Kh", "Ad", "1c", "2d")
     *
     * @return int return a value of low or high of this card
     */
    function getValue($shouldReturnHighs = false)
    {
        if ($shouldReturnHighs) {
            if ($this->value <= 4) { //this will cover all the cased of ace being in the middle (ex: Q K A 2 3 or K A 2 3 4 etc)
                return $this->value + 13;
            }
        }

        return $this->value;
    }

    /**
     * @return string returns the ranks of this card which is one of A,2..10,J,Q,K for a card of same suit
     */
    function getRank()
    {
        return $this->rank;
    }

    /**
     * @return string returns one of 's'=spades, 'd'=diamonds, 'c'=clubs, 'h'=harts as the suit of this card
     */
    function getSuit()
    {
        return $this->suit;
    }

    /**
     *  Given a full face name, this function creates an object of the card and returns it
     * @param $cardNameStr concatted full name of a card consisting rank.suit for example "Ah" for Ace of harts or "10d"
     *   for 10 of spades
     *
     * @return Card
     */
    public static function createByName($cardNameStr)
    {
        $rank = substr($cardNameStr, 0, strlen($cardNameStr) - 1);
        $suit = substr($cardNameStr, strlen($rank), strlen($cardNameStr));

        $value = 0;
        switch ($rank) {
            case "A":
                $value = 1;
                break;
            case "J":
                $value = 11;
                break;
            case "Q":
                $value = 12;
                break;
            case "K":
                $value = 13;
                break;
            default:
                $value = $rank;
        }

        return new Card($value, $rank, $suit);
    }

}
