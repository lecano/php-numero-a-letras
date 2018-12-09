<?php

namespace NumeroALetras;

class NumeroALetras
{
    private static $UNIDADES = [
        '',
        'UN ',
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

    private static $DECENAS = [
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

    private static $CENTENAS = [
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

    public static function convertir(float $number, string $currency = '')
    {
        $base_number = round($number, 2);
        $converted = '';
        $decimales = '';

        if (($base_number < 0) || ($base_number > 999999999)) {
            return 'No es posible convertir el número en letras';
        }

        $div_decimales = explode('.', $base_number);

        if (count($div_decimales) > 1) {
            $base_number = $div_decimales[0];
            $decNumberStr = (string)$div_decimales[1];
            if (strlen($decNumberStr) == 1) {
                $decNumberStr .= '0';
            }
            if (strlen($decNumberStr) == 2) {
                $decNumberStrFill = str_pad($decNumberStr, 9, '0', STR_PAD_LEFT);
                $decCientos = substr($decNumberStrFill, 6);
                $decimales = self::convertirGrupo($decCientos);
            }
        }

        $numberStr = (string)$base_number;
        $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
        $millones = substr($numberStrFill, 0, 3);
        $miles = substr($numberStrFill, 3, 3);
        $cientos = substr($numberStrFill, 6);        

        if ($div_decimales[0] == 0) {
            $converted .= 'CERO';
        }

        if (intval($millones) > 0) {
            if ($millones == '001') {
                $converted .= 'UN MILLON ';
            } else if (intval($millones) > 0) {
                $converted .= sprintf('%sMILLONES ', self::convertirGrupo($millones));
            }
        }

        if (intval($miles) > 0) {
            if ($miles == '001') {
                $converted .= 'MIL ';
            } else if (intval($miles) > 0) {
                $converted .= sprintf('%sMIL ', self::convertirGrupo($miles));
            }
        }

        if (intval($cientos) > 0) {
            if ($cientos == '001') {
                $converted .= '';
            } else if (intval($cientos) > 0) {
                $converted .= sprintf('%s ', self::convertirGrupo($cientos));
            }
        }
        
        if (empty($decimales)) {
            $valor_convertido = trim($converted) . ' CON ' . '00/100 ' . mb_strtoupper($currency);
        } else {
            $valor_convertido = trim($converted) . ' CON ' . $decNumberStr . '/100 ' . mb_strtoupper($currency);
        }

        return trim($valor_convertido);
    }

    private static function convertirGrupo($n)
    {
        $output = '';

        if ($n == '100') {
            $output = "CIEN ";
        } else if ($n[0] !== '0') {
            $output = self::$CENTENAS[$n[0] - 1];
        }

        $k = intval(substr($n, 1));

        if ($k <= 20) {
            $output .= self::$UNIDADES[$k];
        } else {
            if (($k > 30) && ($n[2] !== '0')) {
                $output .= sprintf('%sY %s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            } else {
                $output .= sprintf('%s%s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            }
        }

        return $output;
    }
}