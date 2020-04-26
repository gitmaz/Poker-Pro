<?php

/**
 * Class ExampleTests
 *
 * Sample test case suit
 * @author Maziar Navabi <mn.usyd@gmail.com> 24/04/2020
 */
class ExampleTests extends \PHPUnit_Framework_TestCase
{

    /**
     * @var
     */
    protected $classUnderTestInstance;


    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $settings  = array();


        $reflector = new \ReflectionClass($this);

        foreach ($reflector->getConstants() as $key => $value)
        {
            $settings[strtolower($key)] = $value;
        }

        //$this->classUnderTestInstance = new \ClassUnderTest($settings);
    }


    /**
     * an example test case
     */
    public function testExampleCase()
    {

        $data     = $this->classUnderTestInstance->doSomthing();
        $expected = "expected output";

        $this->assertContains($expected, $data);
    }

}
