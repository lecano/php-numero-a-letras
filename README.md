## Número en Letras

## Descripción
Convierte un número a letras con formato de moneda para facturación electrónica.

## Instalación
Puedes instalar este paquete mediante composer:

```bash
composer require luecano/numero-a-letras
```

## Uso
Debes agregar `use NumeroALetras\NumeroALetras;` en tu archivo PHP.

Usar la función `NumeroALetras::convertir($numero, $moneda)` para convertir el número a letras.

### PHP

```php
<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use NumeroALetras\NumeroALetras;

echo NumeroALetras::convertir(1230.99, 'soles');
echo NumeroALetras::convertir(1230, 'dólares');
```

### Laravel

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use NumeroALetras\NumeroALetras;

class HomeController extends Controller
{
    public function index()
    {
        return NumeroALetras::convertir(1230.99,'soles');    
        // return NumeroALetras::convertir(1230,'dólares');
    }
}
```
### Resultado

```html
MIL DOSCIENTOS TREINTA CON 99/100 SOLES
MIL DOSCIENTOS TREINTA CON 00/100 DÓLARES
```
