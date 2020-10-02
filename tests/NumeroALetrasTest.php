<?php

namespace Luecano\NumeroALetras\Tests;

use Luecano\NumeroALetras\NumeroALetras;
use PHPUnit\Framework\TestCase;

class NumeroALetrasTest extends TestCase
{
    public function MethodToWordsProvider()
    {
        return [
            [100, 'CIEN'],
            [16, 'DIECISÉIS'],
            [1016, 'MIL DIECISÉIS'],
            [84, 'OCHENTA Y CUATRO'],
        ];
    }

    /**
     * @dataProvider MethodToWordsProvider
     *
     * @param int    $number
     * @param string $expected
     */
    public function testToWords(int $number, string $expected)
    {
        $formatter = new NumeroALetras();

        $this->assertEquals($expected, $formatter->toWords($number));
    }

    public function testToWordsThousands()
    {
        $formatter = new NumeroALetras();
        $this->assertEquals('MIL CIEN', $formatter->toWords(1100));
    }

    public function testToMoney()
    {
        $formatter = new NumeroALetras();

        $this->assertEquals('MIL CIEN SOLES', $formatter->toMoney(1100, 2, 'SOLES', 'CENTIMOS'));
    }

    public function testToMoneyFloat()
    {
        $formatter = new NumeroALetras();
        $this->assertEquals('DIEZ SOLES CON DIEZ CENTIMOS', $formatter->toMoney(10.10, 2, 'SOLES', 'CENTIMOS'));
    }

    public function testToInvoice()
    {
        $formatter = new NumeroALetras();

        $this->assertEquals('CIEN CON 00/100 SOLES', $formatter->toInvoice(100, 2, 'soles'));
    }

    public function testToInvoiceFloat()
    {
        $formatter = new NumeroALetras();
        $this->assertEquals('MIL SETECIENTOS CON 50/100 SOLES', $formatter->toInvoice(1700.50, 2, 'SOLES'));
    }

    public function testApocope()
    {
        $formatter = new NumeroALetras();
        $formatter->apocope = true;
        $this->assertEquals('CIENTO UN', $formatter->toWords(101));
    }

    public function testConector()
    {
        $formatter = new NumeroALetras();
        $formatter->conector = 'Y';
        $this->assertEquals('DIEZ PESOS Y DIEZ CENTAVOS', $formatter->toMoney(10.10, 2, 'pesos', 'centavos'));
    }

    public function testToString()
    {
        $formatter = new NumeroALetras();
        $this->assertEquals('CINCO AÑOS CON DOS MESES', $formatter->toString(5.2, 1, 'años', 'meses'));
    }
}
