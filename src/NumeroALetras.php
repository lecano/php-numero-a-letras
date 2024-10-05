<?php

namespace Luecano\NumeroALetras;

use ParseError;

class NumeroALetras
{

    /**
     * @var array $unidades
     * 
     * Array that contains the Spanish words for numbers from 0 to 20.
     * Each index corresponds to the number it represents.
     * 
     * Example:
     * - $unidades[1] returns 'UNO '
     * - $unidades[10] returns 'DIEZ '
     */
    private $unidades = [
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
        'DIECISÉIS ',
        'DIECISIETE ',
        'DIECIOCHO ',
        'DIECINUEVE ',
        'VEINTE ',
    ];

    /**
     * @var array $decenas Array containing Spanish words for tens (decades).
     * 
     * This array is used to convert numbers into their corresponding Spanish words
     * for tens. The values represent the words for twenty, thirty, forty, fifty,
     * sixty, seventy, eighty, ninety, and one hundred.
     */
    private $decenas = [
        'VEINTI',
        'TREINTA ',
        'CUARENTA ',
        'CINCUENTA ',
        'SESENTA ',
        'SETENTA ',
        'OCHENTA ',
        'NOVENTA ',
        'CIEN ',
    ];

    /**
     * Array of strings representing the hundreds in Spanish.
     *
     * @var string[]
     */
    private $centenas = [
        'CIENTO ',
        'DOSCIENTOS ',
        'TRESCIENTOS ',
        'CUATROCIENTOS ',
        'QUINIENTOS ',
        'SEISCIENTOS ',
        'SETECIENTOS ',
        'OCHOCIENTOS ',
        'NOVECIENTOS ',
    ];

    /**
     * Array of exceptions for accented words.
     * 
     * This array contains specific words that require accents in their 
     * representation. The key is the word without the accent, and the 
     * value is the word with the correct accent.
     * 
     * @var array
     */
    private $acentosExcepciones = [
        'VEINTIDOS'  => 'VEINTIDÓS ',
        'VEINTITRES' => 'VEINTITRÉS ',
        'VEINTISEIS' => 'VEINTISÉIS ',
    ];

    /**
     * @var string $conector The connector string used in the NumeroALetras class.
     */
    public $conector = 'CON';

    /**
     * @var bool $apocope
     * 
     * This property determines whether the apocope (shortened form) of numbers should be used.
     * When set to true, the apocope form will be applied.
     * Default value is false.
     */
    public $apocope = false;

    /**
     * Converts a numeric value to its word representation.
     *
     * @param float|int $number The number to be converted.
     * @param int $decimals The number of decimal places to consider. Default is 2.
     * @return string The word representation of the number.
     */
    public function toWords(float|int $number, int $decimals = 2): string
    {
        $this->checkApocope();

        $number = number_format($number, $decimals, '.', '');

        $splitNumber = explode('.', $number);

        $splitNumber[0] = $this->wholeNumber($splitNumber[0]);

        if (!empty($splitNumber[1])) {
            $splitNumber[1] = $this->convertNumber($splitNumber[1]);
        }

        return $this->concat($splitNumber);
    }

    /**
     * Converts a numeric value to its money representation in words.
     *
     * @param float $number The numeric value to be converted.
     * @param int $decimals The number of decimal places to consider. Default is 2.
     * @param string $currency The currency to append to the whole number part. Default is an empty string.
     * @param string $cents The currency to append to the decimal part. Default is an empty string.
     * @return string The money representation of the number in words.
     */
    public function toMoney(float $number, int $decimals = 2, string $currency = '', string $cents = ''): string
    {
        $this->checkApocope();

        $number = number_format($number, $decimals, '.', '');

        $splitNumber = explode('.', $number);

        $splitNumber[0] = $this->wholeNumber($splitNumber[0]) . ' ' . mb_strtoupper($currency, 'UTF-8');

        if (!empty($splitNumber[1])) {
            $splitNumber[1] = $this->convertNumber($splitNumber[1]);
        }

        if (!empty($splitNumber[1])) {
            $splitNumber[1] .= ' ' . mb_strtoupper($cents, 'UTF-8');
        }

        return $this->concat($splitNumber);
    }

    /**
     * Converts a number to its string representation.
     *
     * @param float|int $number The number to be converted.
     * @param int $decimals The number of decimal places to include in the string representation. Default is 2.
     * @param string $whole_str The string to use for the whole number part. Default is an empty string.
     * @param string $decimal_str The string to use for the decimal part. Default is an empty string.
     * @return string The string representation of the number.
     */
    public function toString(float|int $number, int $decimals = 2, string $whole_str = '', string $decimal_str = ''): string
    {
        return $this->toMoney($number, $decimals, $whole_str, $decimal_str);
    }

    /**
     * Converts a number to its invoice representation in words.
     *
     * @param float $number The number to be converted.
     * @param int $decimals The number of decimal places to consider. Default is 2.
     * @param string $currency The currency to append to the converted number. Default is an empty string.
     * @return string The number converted to its invoice representation in words, followed by the currency in uppercase.
     */
    public function toInvoice(float $number, int $decimals = 2, string $currency = ''): string
    {
        $this->checkApocope();

        $number = number_format($number, $decimals, '.', '');

        $splitNumber = explode('.', $number);

        $splitNumber[0] = $this->wholeNumber($splitNumber[0]);

        if (!empty($splitNumber[1])) {
            $splitNumber[1] .= '/100 ';
        } else {
            $splitNumber[1] = '00/100 ';
        }

        return $this->concat($splitNumber) . mb_strtoupper($currency, 'UTF-8');
    }

    /**
     * Checks if the apocope flag is set to true and modifies the 'unidades' array accordingly.
     *
     * If the apocope flag is true, the value at index 1 of the 'unidades' array is set to 'UN '.
     *
     * @return void
     */
    private function checkApocope(): void
    {
        if ($this->apocope === true) {
            $this->unidades[1] = 'UN ';
        }
    }

    /**
     * Converts a whole number to its corresponding word representation.
     *
     * This method takes a numeric string and converts it to its word representation.
     * If the number is '0', it returns 'CERO '. Otherwise, it uses the convertNumber
     * method to convert the number.
     *
     * @param string $number The numeric string to be converted.
     * @return string The word representation of the number.
     */
    private function wholeNumber(string $number): string
    {
        if ($number == '0') {
            $number = 'CERO ';
        } else {
            $number = $this->convertNumber($number);
        }

        return $number;
    }

    /**
     * Concatenates an array of strings with a connector.
     *
     * This method takes an array of strings, filters out any empty values,
     * and then concatenates the remaining values using a connector string.
     * The connector string is converted to uppercase using UTF-8 encoding.
     *
     * @param array $splitNumber The array of strings to concatenate.
     * @return string The concatenated string.
     */
    private function concat(array $splitNumber): string
    {
        return implode(' ' . mb_strtoupper($this->conector, 'UTF-8') . ' ', array_filter($splitNumber));
    }

    /**
     * Converts a numeric value into its corresponding Spanish words representation.
     *
     * This function handles numbers from 0 to 999,999,999. It divides the number into
     * millions, thousands, and hundreds, and converts each group into words.
     *
     * @param int $number The number to be converted. Must be between 0 and 999,999,999.
     * 
     * @return string The number converted into Spanish words.
     * 
     * @throws ParseError If the number is less than 0 or greater than 999,999,999.
     */
    private function convertNumber(int $number): string
    {
        $converted = '';

        if (($number < 0) || !is_numeric($number)) {
            throw new ParseError('Invalid number');
        }

        $numberStrFill = str_pad($number, 9, '0', STR_PAD_LEFT);
        $millones = substr($numberStrFill, 0, 3);
        $miles = substr($numberStrFill, 3, 3);
        $cientos = substr($numberStrFill, 6);

        if (intval($millones) > 0) {
            if ($millones == '001') {
                $converted .= 'UN MILLÓN ';
            } elseif (intval($millones) > 0) {
                $converted .= sprintf('%sMILLONES ', $this->convertGroup($millones));
            }
        }

        if (intval($miles) > 0) {
            if ($miles == '001') {
                $converted .= 'MIL ';
            } elseif (intval($miles) > 0) {
                $converted .= sprintf('%sMIL ', $this->convertGroup($miles));
            }
        }

        if (intval($cientos) > 0) {
            if ($cientos == '001') {
                $this->apocope === true ? $converted .= 'UN ' : $converted .= 'UNO ';
            } elseif (intval($cientos) > 0) {
                $converted .= sprintf('%s ', $this->convertGroup($cientos));
            }
        }

        return trim($converted);
    }

    /**
     * Converts a group of numbers into its corresponding Spanish words representation.
     *
     * This function converts a group of numbers (from 0 to 999) into its corresponding
     * Spanish words representation. It handles the hundreds, tens, and units of the group.
     *
     * @param string $n The group of numbers to be converted.
     * 
     * @return string The group of numbers converted into Spanish words.
     */

    private function convertGroup(string $group): string
    {
        $output = '';

        if ($group == '100') {
            $output = 'CIEN ';
        } elseif ($group[0] !== '0') {
            $output = $this->centenas[$group[0] - 1];
        }

        $k = intval(substr($group, 1));

        if ($k <= 20) {
            $unidades = $this->unidades[$k];
        } else {
            if (($k > 30) && ($group[2] !== '0')) {
                $unidades = sprintf('%sY %s', $this->decenas[intval($group[1]) - 2], $this->unidades[intval($group[2])]);
            } else {
                $unidades = sprintf('%s%s', $this->decenas[intval($group[1]) - 2], $this->unidades[intval($group[2])]);
            }
        }

        $output .= array_key_exists(trim($unidades), $this->acentosExcepciones) ?
            $this->acentosExcepciones[trim($unidades)] : $unidades;

        return $output;
    }
}
