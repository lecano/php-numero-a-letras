## Número a Letras

[![Latest Stable Version](https://poser.pugx.org/luecano/numero-a-letras/v/stable)](https://packagist.org/packages/luecano/numero-a-letras)
[![Total Downloads](https://poser.pugx.org/luecano/numero-a-letras/downloads)](https://packagist.org/packages/luecano/numero-a-letras)
[![GitHub issues](https://img.shields.io/github/issues/luecano/numero-a-letras.svg)](https://github.com/luecano/numero-a-letras/issues)
[![GitHub stars](https://img.shields.io/github/stars/luecano/numero-a-letras.svg)](https://github.com/luecano/numero-a-letras/stargazers)
[![License](https://poser.pugx.org/luecano/numero-a-letras/license)](https://packagist.org/packages/luecano/numero-a-letras)

## Descripción

Librería PHP para convertir un número a su representación en letras para facturación electrónica. Funciona para varios países y monedas.

## Instalación

Instalar paquete usando Composer:

```bash
composer require luecano/numero-a-letras
```

## Uso

Agregar la referencia `use NumeroALetras\NumeroALetras;` en nuestro archivo PHP.

Usar la función `NumeroALetras::convertir($number, $currency, $upper)` para convertir un número a letras.

Los parámetros que recibe la función son:

- `$number` (requerido) recibe un valor numérico, el valor se redondea a dos decimales por defecto.

- `$currency` (opcional) recibe una cadena de texto con el nombre o definición de la moneda. Valor por defecto es `''` o cadena vacia.

- `$upper` (opcional) recibe un boleano para indicar si el resultado debe mostrarse en mayúculas o minúsculas. Valor por defecto es `true`.

## Ejemplos de uso

### Ejemplo usando solo PHP

```php
<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use NumeroALetras\NumeroALetras;

echo NumeroALetras::convertir(99.99, 'soles');
echo NumeroALetras::convertir(99.99, 'soles', false);
echo NumeroALetras::convertir(100, 'pesos');
echo NumeroALetras::convertir(100);
echo NumeroALetras::convertir(1230.02, 'euros');
echo NumeroALetras::convertir(38230.44, 'dólares');
```

### Ejemplo usando Laravel

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use NumeroALetras\NumeroALetras;

class HomeController extends Controller
{
    public function index()
    {
        return NumeroALetras::convertir(99.99, 'soles');
        // return NumeroALetras::convertir(99.99, 'soles', false);
        // return NumeroALetras::convertir(100, 'pesos');
        // return NumeroALetras::convertir(100);
        // return NumeroALetras::convertir(1230.02, 'euros');
        // return NumeroALetras::convertir(38230.44, 'dólares');
    }
}
```

### Resultados

```html
NOVENTA Y NUEVE CON 99/100 SOLES
noventa y nueve con 99/100 soles
CIEN CON 00/100 PESOS
CIEN CON 00/100
MIL DOSCIENTOS TREINTA CON 02/100 EUROS
TREINTA Y OCHO MIL DOSCIENTOS TREINTA CON 44/100 DÓLARES
```
