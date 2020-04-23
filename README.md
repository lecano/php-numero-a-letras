## Número a Letras

[![tests](https://github.com/luecano/numero-a-letras/workflows/tests/badge.svg)](https://github.com/luecano/numero-a-letras/actions)
[![Latest Stable Version](https://poser.pugx.org/luecano/numero-a-letras/v/stable)](https://packagist.org/packages/luecano/numero-a-letras)
[![Total Downloads](https://poser.pugx.org/luecano/numero-a-letras/downloads)](https://packagist.org/packages/luecano/numero-a-letras)
[![License](https://poser.pugx.org/luecano/numero-a-letras/license)](https://packagist.org/packages/luecano/numero-a-letras)

Librería PHP para convertir un número a su valor correspondiente en letras.

## Instalar

Instalar usando Composer

```bash
composer require luecano/numero-a-letras
```

## Uso

Para convertir un número a letras.

```php
use Luecano\NumeroALetras\NumeroALetras;

$formatter = new NumeroALetras;
echo $formatter->toWords($number, $decimals);
```

Parámetros:

- `$number` (requerido) El número a convertir.

- `$decimals` (opcional) Establece el número de puntos decimales, valor por defecto es 2.

Para convertir un número a letras en formato moneda.

```php
use Luecano\NumeroALetras\NumeroALetras;

$formatter = new NumeroALetras;
echo $formatter->toMoney($number, $decimals, $currency, $cents)
```

Parámetros:

- `$number` (requerido) El número a convertir.

- `$decimals` (opcional) Establece el número de puntos decimales, valor por defecto es 2.

- `$currency` (opcional) Establece el nombre o código de moneda para la parte entera, valor por defecto es ''.

- `$cents` (opcional) Establece el nombre o código para la parte decimal, valor por defecto es ''.

Para convertir un número a letras en formato de facturación electrónica SUNAT.

```php
use Luecano\NumeroALetras\NumeroALetras;

$formatter = new NumeroALetras;
echo $formatter->toInvoice($number, $decimals, $currency)
```

Parámetros:

- `$number` (requerido) El número a convertir.

- `$decimals` (opcional) Establece el número de puntos decimales, valor por defecto es 2.

- `$currency` (opcional) Establece el nombre o código de moneda, valor por defecto es ''.

### Apócope de uno

Para cambiar la palabra 'UNO' por 'UN' hacer lo siguiente:

```php
use Luecano\NumeroALetras\NumeroALetras;

$formatter = new NumeroALetras;
$formatter->apocope = true;
echo $formatter->toWords($number);
```

### Conector

Para cambiar la palabra 'CON' por otra de su preferencia hacer lo siguiente:

```php
use Luecano\NumeroALetras\NumeroALetras;

$formatter = new NumeroALetras;
$formatter->conector = 'Y';
echo $formatter->toWords($number);
```

## Ejemplos

```php
use Luecano\NumeroALetras\NumeroALetras;

$formatter = new NumeroALetras;
echo $formatter->toWords(1100)

//MIL CIEN
```

```php
use Luecano\NumeroALetras\NumeroALetras;

$formatter = new NumeroALetras;
echo $formatter->toMoney(10.10, 2, 'SOLES', 'CENTIMOS');

//DIEZ SOLES CON DIEZ CENTIMOS
```

```php
use Luecano\NumeroALetras\NumeroALetras;

$formatter = new NumeroALetras;
echo $formatter->toInvoice(1700.50, 2, 'soles');

//MIL SETECIENTOS CON 50/100 SOLES
```

```php
use Luecano\NumeroALetras\NumeroALetras;

$formatter = new NumeroALetras;
$formatter->apocope = true;
echo $formatter->toWords(101) . ' AÑOS';

//CIENTO UN AÑOS
```

```php
use Luecano\NumeroALetras\NumeroALetras;

$formatter = new NumeroALetras;
$formatter->conector = 'Y';
echo $formatter->toMoney(11.10, 2, 'pesos', 'centavos');

//ONCE PESOS Y DIEZ CENTAVOS
```

### Documentación v1.4

Para consultar la versión anterior por favor usar [1.4 branch](https://github.com/luecano/numero-a-letras/tree/1.4).
