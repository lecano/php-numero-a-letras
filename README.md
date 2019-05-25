## Número a Letras
[![Latest Stable Version](https://poser.pugx.org/luecano/numero-a-letras/v/stable)](https://packagist.org/packages/luecano/numero-a-letras)
[![Total Downloads](https://poser.pugx.org/luecano/numero-a-letras/downloads)](https://packagist.org/packages/luecano/numero-a-letras)
[![GitHub issues](https://img.shields.io/github/issues/luecano/numero-a-letras.svg)](https://github.com/luecano/numero-a-letras/issues)
[![GitHub stars](https://img.shields.io/github/stars/luecano/numero-a-letras.svg)](https://github.com/luecano/numero-a-letras/stargazers)
[![License](https://poser.pugx.org/luecano/numero-a-letras/license)](https://packagist.org/packages/luecano/numero-a-letras)

## Descripción
Librería PHP para convertir un número a su representación en letras requerido para la facturación electrónica. Funciona para varios países y monedas.

## Instalación
Instalar este paquete mediante composer:

```bash
composer require luecano/numero-a-letras
```

## Uso
Agregar la referencia a la libreria `use NumeroALetras\NumeroALetras;` en nuestro archivo PHP.

Usar la función `NumeroALetras::convertir($numero, $moneda)` para convertir el número a letras donde:

* El primer parámetro recibe un elemento numérico o cadena de texto representando un valor numérico, el valor se redondea a precisión de hasta dos decimales.

* El segundo parámetro recibe una cadena de texto con el nombre o definición de la moneda.

* El resultado se mostrará en mayúsculas por defecto.

## Ejemplos de uso
### PHP

```php
<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use NumeroALetras\NumeroALetras;

echo NumeroALetras::convertir(99.99, 'soles');
echo NumeroALetras::convertir('99.99', 'pesos');
echo NumeroALetras::convertir(1230.02, 'euros');
echo NumeroALetras::convertir(38230.44, 'dólares'); 
```

### Laravel

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Importar librería
use NumeroALetras\NumeroALetras;

class HomeController extends Controller
{
    public function index()
    {
        return NumeroALetras::convertir(99.99, 'soles');  
        // return NumeroALetras::convertir('99.99', 'pesos');
        // return NumeroALetras::convertir(1230.02, 'euros');
        // return NumeroALetras::convertir(38230.44, 'dólares'); 
    }
}
```

### Resultado

```html
NOVENTA Y NUEVE CON 99/100 SOLES
NOVENTA Y NUEVE CON 99/100 PESOS
MIL DOSCIENTOS TREINTA CON 02/100 EUROS
TREINTA Y OCHO MIL DOSCIENTOS TREINTA CON 44/100 DÓLARES
```
