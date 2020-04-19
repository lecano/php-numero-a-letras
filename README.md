## Número a Letras

[![tests](https://github.com/luecano/numero-a-letras/workflows/tests/badge.svg)](https://github.com/luecano/numero-a-letras/actions)
[![Latest Stable Version](https://poser.pugx.org/luecano/numero-a-letras/v/stable)](https://packagist.org/packages/luecano/numero-a-letras)
[![Total Downloads](https://poser.pugx.org/luecano/numero-a-letras/downloads)](https://packagist.org/packages/luecano/numero-a-letras)
[![License](https://poser.pugx.org/luecano/numero-a-letras/license)](https://packagist.org/packages/luecano/numero-a-letras)

Librería PHP para convertir un número a letras. Ideal para facturacion electrónica.

Funciona para varios países y monedas.

## Instalar

Puede instalar este paquete mediante Composer

```bash
composer require luecano/numero-a-letras
```

Puede actualizar este paquete mediante Composer

```bash
composer update luecano/numero-a-letras
```

## Uso

```php
require 'vendor/autoload.php';

use Luecano\NumeroALetras\NumeroALetras;

$numeroALetras = NumeroALetras::convert($number, $currency, $upper);
echo $numeroALetras;
```

Los parámetros que recibe la función son:

- `$number` (requerido) recibe `float`, el valor se redondea a dos decimales por defecto. Valores aceptados 0 a 999999999.

- `$currency` (opcional) recibe `string` con el nombre o definición de la moneda, ejemplo: soles, pesos, dólares, euros, etc. Valor por defecto es `''` o cadena vacia.

- `$upper` (opcional) recibe `boolean` para indicar si el resultado debe mostrarse en mayúculas o minúsculas. Valor por defecto es `true`.

## Ejemplos

```php
$numeroALetras = NumeroALetras::convert(99.99, 'soles');
echo $numeroALetras;

//NOVENTA Y NUEVE CON 99/100 SOLES
```

```php
$numeroALetras = NumeroALetras::convert(99.99, 'soles', false);
echo $numeroALetras;

//noventa y nueve con 99/100 soles
```

```php
$numeroALetras = NumeroALetras::convert(100, 'pesos');
echo $numeroALetras;

//CIEN CON 00/100 PESOS
```

```php
$numeroALetras = NumeroALetras::convert(101, 'soles');
echo $numeroALetras;

//CIENTO UNO CON 00/100 SOLES
```

```php
$numeroALetras = NumeroALetras::convert(38230.44, 'dólares');
echo $numeroALetras;

//TREINTA Y OCHO MIL DOSCIENTOS TREINTA CON 44/100 DÓLARES
```
