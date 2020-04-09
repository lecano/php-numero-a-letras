<?php

namespace Luecano\NumeroALetras;

class NumeroALetras
{
    /**
     * @var array
     */
    private static $UNITS = [
        '',
        'UNO ',
        'DOS ',
        'TRES ',
        'CUATRO ',
        'CINCO ',
        'SEIS ',
        'SIETE ',
        'OCHO ',
        'NUEVE ',
        'DIEZ ',
        'ONCE ',
        'DOCE ',
        'TRECE ',
        'CATORCE ',
        'QUINCE ',
        'DIECISEIS ',
        'DIECISIETE ',
        'DIECIOCHO ',
        'DIECINUEVE ',
        'VEINTE '
    ];

    /**
     * @var array
     */
    private static $TENS = [
        'VEINTI',
        'TREINTA ',
        'CUARENTA ',
        'CINCUENTA ',
        'SESENTA ',
        'SETENTA ',
        'OCHENTA ',
        'NOVENTA ',
        'CIEN '
    ];

    /**
     * @var array
     */
    private static $HUNDREDS = [
        'CIENTO ',
        'DOSCIENTOS ',
        'TRESCIENTOS ',
        'CUATROCIENTOS ',
        'QUINIENTOS ',
        'SEISCIENTOS ',
        'SETECIENTOS ',
        'OCHOCIENTOS ',
        'NOVECIENTOS '
    ];

    /**
     * @param float $number
     * @param string $currency
     * @param bool $upper
     * @return string
     */
    public static function convert($number, $currency = '', $upper = true)
    {
        $baseNumber = round($number, 2);
        $output = '';

        if (($baseNumber < 0) || ($baseNumber > 999999999)) {
            return 'No es posible convertir el número en letras';
        }

        $divDecimals = explode('.', $baseNumber);

        if (count($divDecimals) > 1) {
            $baseNumber = $divDecimals[0];
            $decNumberStr = (string) $divDecimals[1];
            if (strlen($decNumberStr) == 1) {
                $decNumberStr .= '0';
            }
            if (strlen($decNumberStr) == 2) {
                $decNumberStrFill = str_pad($decNumberStr, 9, '0', STR_PAD_LEFT);
                $decHundreds = substr($decNumberStrFill, 6);
                $decimals = self::convertGroup($decHundreds);
            }
        }

        $numberStr = (string) $baseNumber;
        $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
        $millions = substr($numberStrFill, 0, 3);
        $thousands = substr($numberStrFill, 3, 3);
        $hundreds = substr($numberStrFill, 6);

        if ($divDecimals[0] == 0) {
            $output .= 'CERO';
        }

        if (intval($millions) > 0) {
            if ($millions == '001') {
                $output .= 'UN MILLON ';
            } else if (intval($millions) > 0) {
                $output .= sprintf('%sMILLONES ', self::convertGroup($millions));
            }
        }

        if (intval($thousands) > 0) {
            if ($thousands == '001') {
                $output .= 'MIL ';
            } else if (intval($thousands) > 0) {
                $output .= sprintf('%sMIL ', self::convertGroup($thousands));
            }
        }

        if (intval($hundreds) > 0) {
            if ($hundreds == '001') {
                $output .= 'UNO';
            } else if (intval($hundreds) > 0) {
                $output .= sprintf('%s ', self::convertGroup($hundreds));
            }
        }

        if (empty($decimals)) {
            $convertedValue = trim($output) . ' CON ' . '00/100 ' . mb_strtoupper($currency);
        } else {
            $convertedValue = trim($output) . ' CON ' . $decNumberStr . '/100 ' . mb_strtoupper($currency);
        }

        $output = trim($convertedValue);

        if (!$upper) {
            return strtolower($output);
        }

        return $output;
    }

    /**
     * @param $n
     * @return mixed|string
     */
    private static function convertGroup($n)
    {
        $output = '';

        if ($n == '100') {
            $output = "CIEN ";
        } else if ($n[0] !== '0') {
            $output = self::$HUNDREDS[$n[0] - 1];
        }

        $k = intval(substr($n, 1));

        if ($k <= 20) {
            $output .= self::$UNITS[$k];
        } else {
            if (($k > 30) && ($n[2] !== '0')) {
                $output .= sprintf('%sY %s', self::$TENS[intval($n[1]) - 2], self::$UNITS[intval($n[2])]);
            } else {
                $output .= sprintf('%s%s', self::$TENS[intval($n[1]) - 2], self::$UNITS[intval($n[2])]);
            }
        }

        return $output;
    }
}
