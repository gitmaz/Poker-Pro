<?php

use Classes\Card;

/**
 * Class CardTests
 *
 * test case suit to test functionality of Card which is a single card repository and parser
 *
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class CardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test that Card can create a single card (given its corresponding rank, suit and index attribute as separate values)
     *
     */
    public function testCanCreateA_CardBySupplyingAttributesSeparately()
    {
        $card = new Card(1, "A", "d");
        $cardFaceNameStr = $card->toString();

        self::assertEquals("Ad", $cardFaceNameStr, "calling new Card(1, \"A\", \"d\") did not result in creation of \"Ad\" card!");

        $cardValue = $card->getValue();
        self::assertEquals(1, $cardValue, "calling new Card(1, \"A\", \"d\") did not result in card with value of 1!");

        $cardRank = $card->getRank();
        self::assertEquals("A", $cardRank, "calling new Card(1, \"A\", \"d\") did not result in card with rank of A!");

        $cardSuit = $card->getSuit();
        self::assertEquals("d", $cardSuit, "calling new Card(1, \"A\", \"d\") did not result in card with suit of d(diamonds)!");
    }

    /**
     * test that CardS can create a single card (parsing the face name str and setting its corresponding member variables for
     *  rank, suit and index)
     */
    public function testCanCreateA_CardBySupplyingAttributesInOneString()
    {
        $card = Card::createByName("Ad");
        $cardFaceNameStr = $card->toString();

        self::assertEquals("Ad", $cardFaceNameStr, "calling Card::createByName(\"Ad\") did not result in creation of \"Ad\" card!");

        $cardValue = $card->getValue();
        self::assertEquals(1, $cardValue, "calling Card::createByName(\"Ad\") did not result in card with value of 1!");

        $cardRank = $card->getRank();
        self::assertEquals("A", $cardRank, "calling Card::createByName(\"Ad\") did not result in card with rank of A!");

        $cardSuit = $card->getSuit();
        self::assertEquals("d", $cardSuit, "calling Card::createByName(\"Ad\") did not result in card with suit of d(diamonds)!");
    }

    /**
     * test if instructed to return a low card high value will return its high (low rank +13) value
     */
    public function testCanGetLowCardsHighOrLowValues()
    {
        $card = Card::createByName("Ad");
        $cardValue = $card->getValue(false);
        self::assertEquals(1, $cardValue, "calling Card::createByName(\"Ad\") did not result in card with low value of 1!");


        $card = Card::createByName("Ad");
        $cardValue = $card->getValue(true);
        self::assertEquals(14, $cardValue, "calling Card::createByName(\"Ad\") did not result in card with high value of 14!");

        $card = Card::createByName("3s");
        $cardValue = $card->getValue(false);
        self::assertEquals(3, $cardValue, "calling Card::createByName(\"3s\") did not result in card with low value of 3!");


        $card = Card::createByName("3s");
        $cardValue = $card->getValue(true);
        self::assertEquals(16, $cardValue, "calling Card::createByName(\"3s\") did not result in card with high value of 16!");


    }


}
