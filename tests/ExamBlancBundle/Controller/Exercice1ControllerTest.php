<?php

namespace ExamBlancBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use ExamBlancBundle\Controller\AlgoController;

class Exercice1ControllerTest extends WebTestCase
{
    private $controller;

    public function __construct()
    {
        $this->controller = new AlgoController();
    }

    public function testInit()
    {
        $this->assertEquals(true, true);
    }
    public function test1 ()
    {
        $this->assertEquals($this->controller->number_of_char("a"), ["a" => 1]);
    }
    public function test2 ()
    {
        $this->assertEquals($this->controller->number_of_char("A"), ["a" => 1]);
    }
    public function test3 ()
    {
        $this->assertEquals($this->controller->number_of_char("ab"), ["a" => 1, "b" => 1]);
    }
    public function test4 ()
    {
        $this->assertEquals($this->controller->number_of_char("aa"), ["a" => 2]);
    }
    public function test5 ()
    {
        $this->assertEquals($this->controller->number_of_char("aAaAaA"), ["a" => 6]);
    }
    public function test6 ()
    {
        $this->assertEquals($this->controller->number_of_char("babababAAbBBba"), ["b" => 8, "a" => 6]);
    }
    public function test7 ()
    {
        $this->assertEquals($this->controller->number_of_char("Hello World"), ["l" => 3, "o" => 2, "h" => 1, "e" => 1, "w" => 1, "r" => 1, "d" => 1]);
    }
    public function test8 ()
    {
        $this->assertEquals($this->controller->number_of_char("Seul, on va plus vite, ensemble, on va plus loin"), ["e" => 5, "l" => 5, "s" => 4, "n" => 4, "u" => 3, "o" => 3, "v" => 3, "a" => 2, "p" => 2, "i" => 2, "t" => 1, "m" => 1, "b" => 1]);
    }
    public function test9 ()
    {
        $this->assertEquals($this->controller->number_of_char("Exige beaucoup de toi-même et attends peu des autres. Ainsi beaucoup d'ennuis te seront épargnés."), ["e" => 14, "u" => 7, "t" => 7, "s" => 7, "a" => 6, "n" => 6, "i" => 5, "o" => 4, "p" => 4, "d" => 4, "r" => 3, "g" => 2, "b" => 2, "c" => 2, "m" => 2, "x" => 1]);
    }
}