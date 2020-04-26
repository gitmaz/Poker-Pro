<?php

use Classes\Card;
use Classes\CardSet;

/**
 * Class CardSetTests
 *
 * test case suit to test functionality of CardSet which is a cards repository, organizer and sorter
 *
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class PlayerTests extends \PHPUnit_Framework_TestCase
{

    /**
     * @var
     */
    protected $cardSet;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $settings = array();


        $reflector = new \ReflectionClass($this);

        foreach ($reflector->getConstants() as $key => $value) {
            $settings[strtolower($key)] = $value;
        }

    }

    /**
     * test that CardSet can create a complete set of cards (when null supplied as parameters)
     */
    public function testCanCreateCompleteSetOfCards()
    {
        $cardSet = new CardSet();
        $completeSetOfCardsStr = $cardSet->toString();

        self::assertEquals("Ad,2d,3d,4d,5d,6d,7d,8d,9d,10d,Jd,Qd,Kd,Ah,2h,3h,4h,5h,6h,7h,8h,9h,10h,Jh,Qh,Kh,As,2s,3s,4s,5s,6s,7s,8s,9s,10s,Js,Qs,Ks,Ac,2c,3c,4c,5c,6c,7c,8c,9c,10c,Jc,Qc,Kc", $completeSetOfCardsStr, "error creating a complete set of cards!");

    }

    /**
     *  test that CardSet can compare two given cards and see which one has a lower rank, regardless of their suit
     */
    public function testCanCompareCardsBasedOnTheirRank()
    {
        $_Ad = Card::createByName("Ad");
        $_Qs = Card::createByName("Qs");

        CardSet::setHighOrLowRules(false);
        $isAdLowerThanQs = CardSet::compareCardsByValue($_Ad, $_Qs);

        self::assertEquals(1, $isAdLowerThanQs, " Ad should have lower rank than Qs using CardSet::compareCardsByValue, but it does'nt");

        CardSet::setHighOrLowRules(true);
        $isAHigherThanQs = CardSet::compareCardsByValue($_Ad, $_Qs);

        self::assertEquals(1, $isAHigherThanQs, " Ad should have higher rank than Qs using CardSet::compareCardsByValue, but it does'nt");

    }

    /**
     * test thad CardSet can sort an arbitrary set of cards that are supplied as its first parameter and 0,0r 1 as second (when both using low or high rules)
     */
    public function testCanSortA_GivenSetOfCards()
    {

        $_Ad = Card::createByName("Ad");
        $_2s = Card::createByName("2s");
        $_3c = Card::createByName("3c");
        $_4h = Card::createByName("4h");
        $_Qd = Card::createByName("Qd");

        $sampleStraightFlushCards = [$_4h, $_3c, $_Qd, $_2s, $_Ad];

        //using low rules
        $cardSet = new CardSet($sampleStraightFlushCards, false);
        $sortedCardsSetAtr = $cardSet->toString();

        $expectedStr = "Qd,4h,3c,2s,Ad";
        self::assertEquals($expectedStr, $sortedCardsSetAtr, "when using low rules sorting $expectedStr, CarsSet resulted in $sortedCardsSetAtr which is not a right sort!");

        //using high rules
        $cardSet = new CardSet($sampleStraightFlushCards, true);
        $sortedCardsSetAtr = $cardSet->toString();

        $expectedStr = "Qd,Ad,2s,3c,4h";
        self::assertEquals($expectedStr, $sortedCardsSetAtr, "when using high rules sorting $expectedStr, CarsSet resulted in $sortedCardsSetAtr which is not a right sort!");

    }
}
