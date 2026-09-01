<?php

namespace Luecano\NumeroALetras\Tests;

use Luecano\NumeroALetras\NumeroALetras;
use ParseError;
use PHPUnit\Framework\TestCase;

class NumerosGrandesTest extends TestCase
{
    /** @var NumeroALetras */
    private $formatter;

    protected function setUp(): void
    {
        $this->formatter = new NumeroALetras();
    }

    // ──────────────────────────────────────────────
    // Miles de millones (10^9)
    // ──────────────────────────────────────────────

    public function testMilMillones()
    {
        $this->assertEquals(
            'MIL MILLONES',
            $this->formatter->toWords(1000000000, 0)
        );
    }

    public function testDosMilMillones()
    {
        $this->assertEquals(
            'DOS MIL MILLONES',
            $this->formatter->toWords(2000000000, 0)
        );
    }

    public function testMilQuinientosMillones()
    {
        $this->assertEquals(
            'MIL QUINIENTOS MILLONES',
            $this->formatter->toWords(1500000000, 0)
        );
    }

    public function testDiezMilMillones()
    {
        $this->assertEquals(
            'DIEZ MIL MILLONES',
            $this->formatter->toWords(10000000000, 0)
        );
    }

    public function testCienMilMillones()
    {
        $this->assertEquals(
            'CIEN MIL MILLONES',
            $this->formatter->toWords(100000000000, 0)
        );
    }

    public function testNovecientosNoventaYNueveMilMillones()
    {
        $this->assertEquals(
            'NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE MILLONES NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE',
            $this->formatter->toWords(999999999999, 0)
        );
    }

    public function testMilesDeMillonesConUnidades()
    {
        // 1,234,567,890
        $this->assertEquals(
            'MIL DOSCIENTOS TREINTA Y CUATRO MILLONES QUINIENTOS SESENTA Y SIETE MIL OCHOCIENTOS NOVENTA',
            $this->formatter->toWords(1234567890, 0)
        );
    }

    public function testMilesDeMillonesConUnMillonAdicional()
    {
        $this->assertEquals(
            'MIL UN MILLONES',
            $this->formatter->toWords(1001000000, 0)
        );
    }

    // ──────────────────────────────────────────────
    // Billones (10^12) - escala larga
    // ──────────────────────────────────────────────

    public function testUnBillon()
    {
        $this->assertEquals(
            'UN BILLÓN',
            $this->formatter->toWords(1000000000000, 0)
        );
    }

    public function testDosBillones()
    {
        $this->assertEquals(
            'DOS BILLONES',
            $this->formatter->toWords(2000000000000, 0)
        );
    }

    public function testCienBillones()
    {
        $this->assertEquals(
            'CIEN BILLONES',
            $this->formatter->toWords(100000000000000, 0)
        );
    }

    public function testBillonConMillones()
    {
        // 1,500,000,000,000
        $this->assertEquals(
            'UN BILLÓN QUINIENTOS MIL MILLONES',
            $this->formatter->toWords(1500000000000, 0)
        );
    }

    public function testBillonConTodo()
    {
        // 1,234,567,890,123
        $this->assertEquals(
            'UN BILLÓN DOSCIENTOS TREINTA Y CUATRO MIL QUINIENTOS SESENTA Y SIETE MILLONES OCHOCIENTOS NOVENTA MIL CIENTO VEINTITRÉS',
            $this->formatter->toWords(1234567890123, 0)
        );
    }

    public function testMaximo()
    {
        // 999,999,999,999,999
        $this->assertEquals(
            'NOVECIENTOS NOVENTA Y NUEVE BILLONES NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE MILLONES NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE',
            $this->formatter->toWords(999999999999999, 0)
        );
    }

    public function testDosBillonesConUnidades()
    {
        // 2,000,000,000,001
        $this->assertEquals(
            'DOS BILLONES UNO',
            $this->formatter->toWords(2000000000001, 0)
        );
    }

    public function testBillonConMiles()
    {
        // 1,000,000,001,000
        $this->assertEquals(
            'UN BILLÓN MIL',
            $this->formatter->toWords(1000000001000, 0)
        );
    }

    // ──────────────────────────────────────────────
    // Formato moneda con números grandes
    // ──────────────────────────────────────────────

    public function testDineroMilMillones()
    {
        $this->assertEquals(
            'MIL MILLONES PESOS',
            $this->formatter->toMoney(1000000000, 2, 'PESOS', 'CENTAVOS')
        );
    }

    public function testDineroBillon()
    {
        $this->assertEquals(
            'UN BILLÓN DÓLARES',
            $this->formatter->toMoney(1000000000000, 2, 'DÓLARES', 'CENTAVOS')
        );
    }

    public function testDineroBillonConCentavos()
    {
        $this->assertEquals(
            'UN BILLÓN DÓLARES CON CINCUENTA CENTAVOS',
            $this->formatter->toMoney(1000000000000.50, 2, 'DÓLARES', 'CENTAVOS')
        );
    }

    // ──────────────────────────────────────────────
    // Formato factura con números grandes
    // ──────────────────────────────────────────────

    public function testFacturaMilMillones()
    {
        $this->assertEquals(
            'MIL MILLONES CON 00/100 SOLES',
            $this->formatter->toInvoice(1000000000, 2, 'SOLES')
        );
    }

    // ──────────────────────────────────────────────
    // Apócope con números grandes
    // ──────────────────────────────────────────────

    public function testApocopeDeBillon()
    {
        $this->formatter->apocope = true;
        $this->assertEquals(
            'UN BILLÓN',
            $this->formatter->toWords(1000000000000, 0)
        );
    }

    public function testApocopeDeBillonConUno()
    {
        $this->formatter->apocope = true;
        $this->assertEquals(
            'UN BILLÓN UN',
            $this->formatter->toWords(1000000000001, 0)
        );
    }

    // ──────────────────────────────────────────────
    // Excepción para número fuera de rango
    // ──────────────────────────────────────────────

    public function testExcepcionNumeroMuyGrande()
    {
        $this->expectException(ParseError::class);
        $this->formatter->toWords(1000000000000000, 0);
    }

    // ──────────────────────────────────────────────
    // Retrocompatibilidad: números < 1,000,000,000
    // ──────────────────────────────────────────────

    public function retrocompatibilidadProvider()
    {
        return [
            [0, 'CERO '],
            [1, 'UNO'],
            [16, 'DIECISÉIS'],
            [100, 'CIEN'],
            [1000, 'MIL'],
            [1100, 'MIL CIEN'],
            [1016, 'MIL DIECISÉIS'],
            [84, 'OCHENTA Y CUATRO'],
            [1000000, 'UN MILLÓN'],
            [2000000, 'DOS MILLONES'],
            [999999999, 'NOVECIENTOS NOVENTA Y NUEVE MILLONES NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE'],
        ];
    }

    /**
     * @dataProvider retrocompatibilidadProvider
     */
    public function testRetrocompatibilidad(int $number, string $expected)
    {
        $this->assertEquals($expected, $this->formatter->toWords($number, 0));
    }
}
