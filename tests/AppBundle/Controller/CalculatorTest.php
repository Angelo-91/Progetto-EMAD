<?php

// src/AppBundle/Tests/Util/CalculatorTest.php
namespace tests\AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Utility\Calculator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $calc = new Calculator();
        $result = $calc->add(30, 12);

        // asserisce che il calcolatore aggiunga correttamente i numeri!
        $this->assertEquals(42, $result);
    }
}