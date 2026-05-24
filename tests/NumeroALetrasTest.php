<?php

namespace Luecano\NumeroALetras\Tests;

use Luecano\NumeroALetras\NumeroALetras;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class NumeroALetrasTest extends TestCase
{
    public static function MethodToWordsProvider(): array
    {
        return [
            [100, 'CIEN'],
            [16, 'DIECISÉIS'],
            [1016, 'MIL DIECISÉIS'],
            [84, 'OCHENTA Y CUATRO'],
        ];
    }

    #[DataProvider('MethodToWordsProvider')]
    public function testToWords(int $number, string $expected): void
    {
        $formatter = new NumeroALetras();

        $this->assertEquals($expected, $formatter->toWords($number));
    }

    public function testToWordsThousands(): void
    {
        $formatter = new NumeroALetras();
        $this->assertEquals('MIL CIEN', $formatter->toWords(1100));
    }

    public function testToWordsMilMillones(): void
    {
        $formatter = new NumeroALetras();
        $this->assertEquals('MIL MILLONES', $formatter->toWords(1000000000));
    }

    public function testToWordsBillones(): void
    {
        $formatter = new NumeroALetras();
        $this->assertEquals('UN BILLÓN', $formatter->toWords(1000000000000));
        $this->assertEquals('DOS BILLONES', $formatter->toWords(2000000000000));
    }

    public function testToWordsBillonesConMillones(): void
    {
        $formatter = new NumeroALetras();
        $this->assertEquals(
            'UN BILLÓN DOSCIENTOS TREINTA Y CUATRO MIL QUINIENTOS SESENTA Y SIETE MILLONES OCHOCIENTOS NOVENTA MIL CIENTO VEINTITRÉS',
            $formatter->toWords(1234567890123)
        );
    }

    public function testToMoney(): void
    {
        $formatter = new NumeroALetras();

        $this->assertEquals('MIL CIEN SOLES', $formatter->toMoney(1100, 2, 'SOLES', 'CENTIMOS'));
    }

    public function testToMoneyFloat(): void
    {
        $formatter = new NumeroALetras();
        $this->assertEquals('DIEZ SOLES CON DIEZ CENTIMOS', $formatter->toMoney(10.10, 2, 'SOLES', 'CENTIMOS'));
    }

    public function testToInvoice(): void
    {
        $formatter = new NumeroALetras();

        $this->assertEquals('CIEN CON 00/100 SOLES', $formatter->toInvoice(100, 2, 'soles'));
    }

    public function testToInvoiceFloat(): void
    {
        $formatter = new NumeroALetras();
        $this->assertEquals('MIL SETECIENTOS CON 50/100 SOLES', $formatter->toInvoice(1700.50, 2, 'SOLES'));
    }

    public function testApocope(): void
    {
        $formatter = new NumeroALetras();
        $formatter->apocope = true;
        $this->assertEquals('CIENTO UN', $formatter->toWords(101));
    }

    public function testConector(): void
    {
        $formatter = new NumeroALetras();
        $formatter->conector = 'Y';
        $this->assertEquals('DIEZ PESOS Y DIEZ CENTAVOS', $formatter->toMoney(10.10, 2, 'pesos', 'centavos'));
    }

    public function testToString(): void
    {
        $formatter = new NumeroALetras();
        $this->assertEquals('CINCO AÑOS CON DOS MESES', $formatter->toString(5.2, 1, 'años', 'meses'));
    }
}
