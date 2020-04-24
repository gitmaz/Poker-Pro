<?php

use Classes\Player;

/**
 * Class PlayerTests
 *
 * Sample test case suit
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class PlayerTests extends \PHPUnit_Framework_TestCase
{

    /**
     * @var
     */
    protected $player;


    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $settings  = array();

        /** Because I'm lazy... **/
        $reflector = new \ReflectionClass($this);

        foreach ($reflector->getConstants() as $key => $value)
        {
            $settings[strtolower($key)] = $value;
        }

    }


    /**
     * test case for successful straight, ace in the middle hand detection
     */
    public function testCanCreateRandomHandCases()
    {

        $handSelectionStrategy = new \Classes\RandomHandSelection();

        $hand=$handSelectionStrategy->getSample(true);


        $patternHand='/^(([A|J|Q|K]|[2-9]|10)[s|c|h|d],?){5}$/';

        $firstHandStr=$hand->toString();
        $isCorrectHandSet=preg_match($patternHand, $firstHandStr);
        $this->assertEquals($isCorrectHandSet, 1,"failed to create a random hand set: $firstHandStr is not in a correct format as of a set of 5 cards!");

        //get another sample and assert if it is not equal previous one
        $hand=$handSelectionStrategy->getSample(true);
        $secondHandStr=$hand->toString();
        $isCorrectHandSet=preg_match($patternHand, $secondHandStr);
        $this->assertEquals($isCorrectHandSet, 1,"failed to create a random hand set: $secondHandStr is not in a correct format as of a set of 5 cards!");


        $this->assertNotEquals($firstHandStr, $secondHandStr, "failed to create a fresh set of random hand as $firstHandStr is same hand as $secondHandStr!");


    }

    /**
     * test case for successful straight hand detection
     */
    public function testCanDetectStraightCases()
    {

        $handSelectionStrategy = new \Classes\StraightHandSelection();

        $isStraight=false;
        $isFlush=false;
        $hand=Player::checkIfHandIsStraightOrFlush($handSelectionStrategy, $isStraight, $isFlush);

        $handStr=$hand->toString();
        $this->assertTrue($isStraight, 1, "failed to detect ".$handStr."as a straight hand in testCanDetectStraightCases!");
    }

    /**
     * test case for successful straight flush hand detection
     */
    public function testCanDetectStraightFlushCases()
    {

        $handSelectionStrategy = new \Classes\StraightFlushHandSelection();

        $isStraight=false;
        $isFlush=false;
        $hand=Player::checkIfHandIsStraightOrFlush($handSelectionStrategy, $isStraight, $isFlush);

        $handStr=$hand->toString();
        $this->assertTrue($isStraight,"failed to detect ".$handStr."as a straight hand in testCanDetectStraightFlushCases!");
        $this->assertTrue($isFlush, "failed to detect ".$handStr."as a flush hand in testCanDetectStraightFlushCases!");
    }

    /**
     * test case for successful straight ace in the middle hand detection
     */
    public function testCanDetectStraightFlushAceInTheMiddleCases()
    {

        $handSelectionStrategy = new \Classes\StraightAceInTheMiddleHandSelection();

        $isStraight=false;
        $isFlush=false;
        $hand=Player::checkIfHandIsStraightOrFlush($handSelectionStrategy, $isStraight, $isFlush);

        $handStr=$hand->toString();
        $this->assertTrue($isStraight,"failed to detect ".$handStr."as a straight hand in testCanDetectStraightFlushAceInTheMiddleCases!");
    }





}
