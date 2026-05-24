<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Luecano\NumeroALetras\NumeroALetras;

$number = $argv[1] ?? '';

if ($number === '') {
	echo 'Usage: php test-library.php <number> [decimals] [currency] [cents]' . PHP_EOL;
	echo 'Example: php test-library.php 1234567890123.45 2 SOLES CENTIMOS' . PHP_EOL;
	exit(1);
}

$numberValue = (float) $number;
$decimals = isset($argv[2]) ? (int) $argv[2] : 2;
$currency = $argv[3] ?? 'SOLES';
$cents = $argv[4] ?? 'CENTIMOS';

$formatter = new NumeroALetras();

// Optional settings:
// $formatter->apocope = true;
// $formatter->conector = 'CON';

echo "Number: {$number}" . PHP_EOL;
echo 'toWords:   ' . $formatter->toWords($numberValue, $decimals) . PHP_EOL;
echo 'toMoney:   ' . $formatter->toMoney($numberValue, $decimals, $currency, $cents) . PHP_EOL;
echo 'toInvoice: ' . $formatter->toInvoice($numberValue, $decimals, $currency) . PHP_EOL;
