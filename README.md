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

Para convertir un número a letras en formato de factura electrónica.

```php
use Luecano\NumeroALetras\NumeroALetras;

$formatter = new NumeroALetras;
echo $formatter->toInvoice($number, $decimals, $currency)
```

Parámetros:

- `$number` (requerido) El número a convertir.

- `$decimals` (opcional) Establece el número de puntos decimales, valor por defecto es 2.

- `$currency` (opcional) Establece el nombre o código de moneda, valor por defecto es ''.

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

### Documentación v1.4

Para consultar la versión anterior por favor usar [1.4 branch](https://github.com/luecano/numero-a-letras/tree/1.4).
