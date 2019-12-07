## Número a Letras

[![Latest Stable Version](https://poser.pugx.org/luecano/numero-a-letras/v/stable?format=flat-square)](https://packagist.org/packages/luecano/numero-a-letras)
[![Total Downloads](https://poser.pugx.org/luecano/numero-a-letras/downloads?format=flat-square)](https://packagist.org/packages/luecano/numero-a-letras)
[![GitHub issues](https://img.shields.io/github/issues/luecano/numero-a-letras.svg?style=flat-square)](https://github.com/luecano/numero-a-letras/issues)
[![GitHub stars](https://img.shields.io/github/stars/luecano/numero-a-letras.svg?style=flat-square)](https://github.com/luecano/numero-a-letras/stargazers)
[![License](https://poser.pugx.org/luecano/numero-a-letras/license?format=flat-square)](https://packagist.org/packages/luecano/numero-a-letras)

Librería PHP para convertir un número a letras. Ideal para facturacion electrónica.

Funciona para varios países y monedas.

## Instalar

Puedes instalar este paquete mediante Composer

```bash
composer require luecano/numero-a-letras
```

## Uso

```php
require_once __DIR__ . '/../vendor/autoload.php';

use Luecano\NumeroALetras;

$numeroALetras = NumeroALetras::convert($number, $currency, $upper);
echo $numeroALetras;
```

Los parámetros que recibe la función son:

- `$number` (requerido) recibe `float`, el valor se redondea a dos decimales por defecto.

- `$currency` (opcional) recibe `string` con el nombre o definición de la moneda. Valor por defecto es `''` o cadena vacia.

- `$upper` (opcional) recibe `boolean` para indicar si el resultado debe mostrarse en mayúculas o minúsculas. Valor por defecto es `true`.

## Ejemplos

```php
$numeroALetras = NumeroALetras::convert(99.99, 'soles');
echo $numeroALetras;
```

```bash
NOVENTA Y NUEVE CON 99/100 SOLES
```

```php
$numeroALetras = NumeroALetras::convert(99.99, 'soles', false);
echo $numeroALetras;
```

```bash
noventa y nueve con 99/100 soles
```

```php
$numeroALetras = NumeroALetras::convert(100, 'pesos');
echo $numeroALetras;
```

```bash
CIEN CON 00/100 PESOS
```

```php
$numeroALetras = NumeroALetras::convert(38230.44, 'dólares');
echo $numeroALetras;
```

```bash
TREINTA Y OCHO MIL DOSCIENTOS TREINTA CON 44/100 DÓLARES
```
