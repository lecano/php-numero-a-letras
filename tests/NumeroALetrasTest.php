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
        $this->assertEquals('noventa y nueve con 99/100 pesos', NumeroALetras::convert(99.99, 'pesos', false));
    }

    public function testConvertUnits()
    {
        $this->assertEquals('uno con 00/100 soles', NumeroALetras::convert(1, 'soles', false));
    }

    public function testConvertTens()
    {
        $this->assertEquals('once con 00/100 pesos', NumeroALetras::convert(11, 'pesos', false));
    }

    public function testConvertHundreds()
    {
        $this->assertEquals('CIENTO UNO CON 00/100 SOLES', NumeroALetras::convert(101, 'soles'));
    }

    public function testConvertThousands()
    {
        $this->assertEquals('MIL UNO CON 00/100 PESOS', NumeroALetras::convert(1001, 'pesos'));
    }
}
