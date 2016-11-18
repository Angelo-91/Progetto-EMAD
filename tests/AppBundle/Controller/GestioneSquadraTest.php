<?php

// src/AppBundle/Tests/Util/CalculatorTest.php
namespace tests\AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Manager\GestioneSquadra;
use AppBundle\Utility\Calculator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GestioneSquadraTest extends \PHPUnit_Framework_TestCase
{
    public function insertSquadra()
    {
        $g=new GestioneSquadra();
        $nome="Inter";
        $g->insert('2',$nome,"1945","Moratti","via milano","inter.jpg");
        $s=$g->getByName("Inter");
        $this->assertEquals($s->getNome(),$nome);
    }
}