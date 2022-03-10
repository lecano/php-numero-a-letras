## Número a Letras PHP

[![tests](https://github.com/luecano/numero-a-letras/workflows/tests/badge.svg)](https://github.com/luecano/numero-a-letras/actions)
[![StyleCI](https://github.styleci.io/repos/156258800/shield?style=flat&branch=master)](https://github.styleci.io/repos/156258800?branch=master)
[![Latest Stable Version](https://poser.pugx.org/luecano/numero-a-letras/v/stable)](https://packagist.org/packages/luecano/numero-a-letras)
[![Total Downloads](https://poser.pugx.org/luecano/numero-a-letras/downloads)](//packagist.org/packages/luecano/numero-a-letras)
[![License](https://poser.pugx.org/luecano/numero-a-letras/license)](https://packagist.org/packages/luecano/numero-a-letras)

Librería PHP para convertir un número a su valor escrito en [numeral](https://es.wikipedia.org/wiki/Numeral_(ling%C3%BC%C3%ADstica)) (letras, palabras o texto).

## Requisitos

PHP `7.2` o superior.

## Instalar

PHP 7.2 o superior:

```bash
composer require luecano/numero-a-letras "^3.0"
```

PHP 5.6, 7.0 y 7.1:

```bash
composer require luecano/numero-a-letras "^2.0"
```

## Uso

Agregar referencia a librería.

```php

require 'vendor/autoload.php';
use Luecano\NumeroALetras\NumeroALetras;
```

### Convertir un número a letras o palabras

```php
$formatter = new NumeroALetras();
echo $formatter->toWords($number, $decimals);
```

Parámetros:

- int|float `$number` (requerido) El número a convertir.

- int `$decimals` (opcional) Establece el número de decimales, valor por defecto es 2.

### Convertir un número a letras en formato moneda

```php
$formatter = new NumeroALetras();
echo $formatter->toMoney($number, $decimals, $currency, $cents);
```

Parámetros:

- int|float `$number` (requerido) El número a convertir.

- int `$decimals` (opcional) Establece el número de decimales, valor por defecto es 2.

- string `$currency` (opcional) Establece el nombre o código de moneda para la parte entera, valor por defecto es string vacío.

- string `$cents` (opcional) Establece el nombre o código para la parte decimal, valor por defecto es string vacío.

### Convertir un número a letras en formato libre

```php
$formatter = new NumeroALetras();
echo $formatter->toString($number, $decimals, $whole_str, $decimal_str);
```

Parámetros:

- int|float `$number` (requerido) El número a convertir.

- int `$decimals` (opcional) Establece el número de decimales, valor por defecto es 2.

- string `$whole_str` (opcional) Establece el texto para la parte entera, valor por defecto es string vacío.

- string `$decimal_str` (opcional) Establece el texto para la parte decimal, valor por defecto es string vacío.

### Convertir un número a letras en formato de facturación electrónica SUNAT

```php
$formatter = new NumeroALetras();
echo $formatter->toInvoice($number, $decimals, $currency);
```

Parámetros:

- int|float `$number` (requerido) El número a convertir.

- int `$decimals` (opcional) Establece el número de decimales, valor por defecto es 2.

- string `$currency` (opcional) Establece el nombre o código de moneda, valor por defecto es string vacío.

### Apócope de uno

Para cambiar la palabra 'UNO' por 'UN' hacer lo siguiente:

```php
$formatter = new NumeroALetras();
$formatter->apocope = true;
```

### Conector

Para cambiar la palabra 'CON' por otra de su preferencia hacer lo siguiente:

```php
$formatter = new NumeroALetras();
$formatter->conector = 'Y';
```

## Ejemplos de uso

```php
$formatter = new NumeroALetras();
echo $formatter->toWords(1100);

//MIL CIEN
```

```php
$formatter = new NumeroALetras();
$formatter->apocope = true;
echo $formatter->toWords(101) . ' AÑOS';

//CIENTO UN AÑOS
```

```php
$formatter = new NumeroALetras();
echo $formatter->toMoney(2500.90, 2, 'DÓLARES', 'CENTAVOS');

//DOS MIL QUINIENTOS DÓLARES CON NOVENTA CENTAVOS
```

```php
$formatter = new NumeroALetras();
echo $formatter->toMoney(10.10, 2, 'SOLES', 'CENTIMOS');

//DIEZ SOLES CON DIEZ CENTIMOS
```

```php
$formatter = new NumeroALetras();
$formatter->conector = 'Y';
echo $formatter->toMoney(11.10, 2, 'pesos', 'centavos');

//ONCE PESOS Y DIEZ CENTAVOS
```

```php
$formatter = new NumeroALetras();
echo $formatter->toInvoice(1700.50, 2, 'soles');

//MIL SETECIENTOS CON 50/100 SOLES
```

```php
$formatter = new NumeroALetras();
echo $formatter->toString(5.2, 1, 'años', 'meses');

//CINCO AÑOS CON DOS MESES
```

## Contribuciones

Se aceptan contribuciones siguiendo el [GitHub Flow](https://guides.github.com/introduction/flow). Crea una rama, agrega commits y abre un pull request.

## Licencia

Software de código abierto con licencia [MIT license](LICENSE).
