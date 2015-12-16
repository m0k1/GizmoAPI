# GizmoAPI
Gizmo API wrapper for PHP.

## Installation
TODO: Describe the installation process

## Usage
```php
require_once 'vendor/autoload.php';
use Pisa\GizmoAPI\Gizmo;

$gizmo = new Gizmo([
    'http' => [
        'base_uri' => 'http://url_to_gizmo_api_here:8080',
        'auth'     => ['username', 'password'],
    ],
]);

$host = $gizmo->hosts->get(1);

$user = $gizmo->users->get(1);
```

The full API documentation at [wiki](/wikis/ApiIndex)

## History
TODO: Write history

## Credits
`Jani "Zachu" Korhonen <jani.korhonen@hel.fi>`