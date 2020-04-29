<?php

use Classes\Player;

/**
 * Class PlayerTest
 *
 * main test case suit to test final functionality of the Poker-Pro program (ie detection of straightness of a set of
 *  automatically and randomly chosen cards as well as being a flush set).
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class PlayerTest extends \PHPUnit_Framework_TestCase
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
        $settings = array();


        $reflector = new \ReflectionClass($this);

        foreach ($reflector->getConstants() as $key => $value) {
            $settings[strtolower($key)] = $value;
        }

    }


    /**
     * test case for successful creation of random set of cards
     */
    public function testCanCreateRandomHandCases()
    {

        $handSelectionStrategy = new \Classes\RandomHandSelection();

        $hand = $handSelectionStrategy->getSample(true);


        $patternHand = '/^(([A|J|Q|K]|[2-9]|10)[s|c|h|d],?){5}$/';

        $firstHandStr = $hand->toString();
        $isCorrectHandSet = preg_match($patternHand, $firstHandStr);
        $this->assertEquals($isCorrectHandSet, 1, "failed to create a random hand set: $firstHandStr is not in a correct format as of a set of 5 cards!");

        //get another sample and assert if it is not equal previous one
        $hand = $handSelectionStrategy->getSample(true);
        $secondHandStr = $hand->toString();
        $isCorrectHandSet = preg_match($patternHand, $secondHandStr);
        $this->assertEquals($isCorrectHandSet, 1, "failed to create a random hand set: $secondHandStr is not in a correct format as of a set of 5 cards!");


        $this->assertNotEquals($firstHandStr, $secondHandStr, "failed to create a fresh set of random hand as $firstHandStr is same hand as $secondHandStr!");


    }

    /**
     * test case for successful straight hand detection
     */
    public function testCanDetectStraightCases()
    {

        $handSelectionStrategy = new \Classes\StraightHandSelection();

        $isStraight = false;
        $isFlush = false;
        $hand = Player::checkIfHandIsStraightOrFlush($handSelectionStrategy, $isStraight, $isFlush);

        $handStr = $hand->toString();
        $this->assertTrue($isStraight, 1, "failed to detect " . $handStr . "as a straight hand in testCanDetectStraightCases!");
    }

    /**
     * test case for successful straight flush hand detection
     */
    public function testCanDetectStraightFlushCases()
    {

        $handSelectionStrategy = new \Classes\StraightFlushHandSelection();

        $isStraight = false;
        $isFlush = false;
        $hand = Player::checkIfHandIsStraightOrFlush($handSelectionStrategy, $isStraight, $isFlush);

        $handStr = $hand->toString();
        $this->assertTrue($isStraight, "failed to detect " . $handStr . "as a straight hand in testCanDetectStraightFlushCases!");
        $this->assertTrue($isFlush, "failed to detect " . $handStr . "as a flush hand in testCanDetectStraightFlushCases!");
    }

    /**
     * test case for successful straight ace in the middle hand detection
     */
    public function testCanDetectStraightAceInTheMiddleCases()
    {

        $handSelectionStrategy = new \Classes\StraightAceInTheMiddleHandSelection();

        $isStraight = false;
        $isFlush = false;
        $hand = Player::checkIfHandIsStraightOrFlush($handSelectionStrategy, $isStraight, $isFlush);

        $handStr = $hand->toString();
        $this->assertTrue($isStraight, "failed to detect " . $handStr . "as a straight hand in testCanDetectStraightFlushAceInTheMiddleCases!");
    }

    /**
     * test case for successful rejection of misspelled suits in card definitions
     */
    public function testCanRejectMisspelledSuitsInCardDefinitions()
    {

        $handSelectionStrategy = new \Classes\MisspelledSuitHandSelection();

        $isStraight = false;
        $isFlush = false;
        try {
            $hand = Player::checkIfHandIsStraightOrFlush($handSelectionStrategy, $isStraight, $isFlush);
        } catch (Exception $ex) {
            $this->assertContains("suit", $ex->getMessage(), "failed to trigger exception on misspelled suit in a card definition");
        }

    }

    /**
     * test case for successful rejection of wrong ranks in card definitions
     */
    public function testCanRejectWrongRanksInCardDefinitions()
    {

        $handSelectionStrategy = new \Classes\WrongRankHandSelection();

        $isStraight = false;
        $isFlush = false;
        try {
            $hand = Player::checkIfHandIsStraightOrFlush($handSelectionStrategy, $isStraight, $isFlush);
        } catch (Exception $ex) {
            $this->assertContains("rank", $ex->getMessage(), "failed to trigger exception on wrong rank in a card definition");
        }

    }


}
