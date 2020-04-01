<?php

namespace Luecano\NumeroALetras\Tests;

use Luecano\NumeroALetras\NumeroALetras;

use PHPUnit\Framework\TestCase;

class NumeroALetrasTest extends TestCase
{
    public function testConvertToUpper()
    {
        $this->assertEquals('NOVENTA Y NUEVE CON 99/100 SOLES', NumeroALetras::convert(99.99, 'soles'));
    }

    public function testConvertToLower()
    {
        $this->assertEquals('noventa y nueve con 99/100 soles', NumeroALetras::convert(99.99, 'soles', false));
    }
}
