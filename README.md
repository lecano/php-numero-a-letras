## Número a Letras
[![Latest Stable Version](https://poser.pugx.org/luecano/numero-a-letras/v/stable)](https://packagist.org/packages/luecano/numero-a-letras)
[![Total Downloads](https://poser.pugx.org/luecano/numero-a-letras/downloads)](https://packagist.org/packages/luecano/numero-a-letras)
[![GitHub issues](https://img.shields.io/github/issues/luecano/numero-a-letras.svg)](https://github.com/luecano/numero-a-letras/issues)
[![GitHub stars](https://img.shields.io/github/stars/luecano/numero-a-letras.svg)](https://github.com/luecano/numero-a-letras/stargazers)
[![License](https://poser.pugx.org/luecano/numero-a-letras/license)](https://packagist.org/packages/luecano/numero-a-letras)

## Descripción
Convierte un número a letras con formato de moneda para facturación electrónica SUNAT.

## Instalación
Puedes instalar este paquete mediante composer:

```bash
composer require luecano/numero-a-letras
```

## Uso
Debes agregar `use NumeroALetras\NumeroALetras;` en tu archivo PHP.

Usar la función `NumeroALetras::convertir($numero, $moneda)` para convertir el número a letras.

El primer parámetro recibe un elemento numérico con punto decimal + hasta dos decimales.

El segundo parámetro recibe un elemento en formato texto.

### PHP

```php
<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use NumeroALetras\NumeroALetras;

echo NumeroALetras::convertir(99.99, 'soles');
echo NumeroALetras::convertir('99.99', 'soles');
echo NumeroALetras::convertir(90, 'soles');
echo NumeroALetras::convertir(100.111, 'soles'); 
echo NumeroALetras::convertir(1230.02, 'soles');
echo NumeroALetras::convertir(38230.44, 'dólares'); 
```

### Resultado

```html
NOVENTA Y NUEVE CON 99/100 SOLES
NOVENTA Y NUEVE CON 99/100 SOLES
NOVENTA CON 00/100 SOLES
CIEN CON 11/100 SOLES
MIL DOSCIENTOS TREINTA CON 02/100 SOLES
TREINTA Y OCHO MIL DOSCIENTOS TREINTA CON 44/100 DÓLARES
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
        //Llamar función NumeroALetras
        return NumeroALetras::convertir(99.99, 'soles');  
    }
}
