## Número a Letras PHP

[![tests](https://github.com/luecano/numero-a-letras/workflows/tests/badge.svg)](https://github.com/luecano/numero-a-letras/actions)
[![Latest Stable Version](https://poser.pugx.org/luecano/numero-a-letras/v/stable)](https://packagist.org/packages/luecano/numero-a-letras)
[![Total Downloads](https://poser.pugx.org/luecano/numero-a-letras/downloads)](https://packagist.org/packages/luecano/numero-a-letras)
[![License](https://poser.pugx.org/luecano/numero-a-letras/license)](https://packagist.org/packages/luecano/numero-a-letras)

Librería PHP para convertir un número a su valor correspondiente en letras, palabras o texto.

## Instalar

Instalar usando Composer

```bash
composer require luecano/numero-a-letras
```

## Uso

Agregar referencia a librería.

```php

require 'vendor/autoload.php';
use Luecano\NumeroALetras\NumeroALetras;
```

### Convertir un número a letras

```php
$formatter = new NumeroALetras;
echo $formatter->toWords($number, $decimals);
```

Parámetros:

- integer|float `$number` (requerido) El número a convertir.

- integer `$decimals` (opcional) Establece el número de puntos decimales, valor por defecto es 2.

### Convertir un número a letras en formato moneda

```php
$formatter = new NumeroALetras;
echo $formatter->toMoney($number, $decimals, $currency, $cents);
```

Parámetros:

- integer|float `$number` (requerido) El número a convertir.

- integer `$decimals` (opcional) Establece el número de puntos decimales, valor por defecto es 2.

- string `$currency` (opcional) Establece el nombre o código de moneda para la parte entera, valor por defecto es string vacío.

- string `$cents` (opcional) Establece el nombre o código para la parte decimal, valor por defecto es string vacío.

### Convertir un número a letras en formato de facturación electrónica SUNAT

```php
$formatter = new NumeroALetras;
echo $formatter->toInvoice($number, $decimals, $currency);
```

Parámetros:

- integer|float `$number` (requerido) El número a convertir.

- integer `$decimals` (opcional) Establece el número de puntos decimales, valor por defecto es 2.

- string `$currency` (opcional) Establece el nombre o código de moneda, valor por defecto es string vacío.

### Apócope de uno

Para cambiar la palabra 'UNO' por 'UN' hacer lo siguiente:

```php
$formatter = new NumeroALetras;
$formatter->apocope = true;
```

### Conector

Para cambiar la palabra 'CON' por otra de su preferencia hacer lo siguiente:

```php
$formatter = new NumeroALetras;
$formatter->conector = 'Y';
```

## Ejemplos

```php
$formatter = new NumeroALetras;
echo $formatter->toWords(1100);

//MIL CIEN
```

```php
echo (new NumeroALetras)->toMoney(2500.90, 2, 'DÓLARES', 'CENTAVOS');

//DOS MIL QUINIENTOS DÓLARES CON NOVENTA CENTAVOS
```

```php
$formatter = new NumeroALetras;
echo $formatter->toMoney(10.10, 2, 'SOLES', 'CENTIMOS');

//DIEZ SOLES CON DIEZ CENTIMOS
```

```php
$formatter = new NumeroALetras;
echo $formatter->toInvoice(1700.50, 2, 'soles');

//MIL SETECIENTOS CON 50/100 SOLES
```

```php
$formatter = new NumeroALetras;
$formatter->apocope = true;
echo $formatter->toWords(101) . ' AÑOS';

//CIENTO UN AÑOS
```

```php
$formatter = new NumeroALetras;
$formatter->conector = 'Y';
echo $formatter->toMoney(11.10, 2, 'pesos', 'centavos');

//ONCE PESOS Y DIEZ CENTAVOS
```

### Documentación v1.4

Para consultar la versión v1 usar [1.4 branch](https://github.com/luecano/numero-a-letras/tree/1.4).
