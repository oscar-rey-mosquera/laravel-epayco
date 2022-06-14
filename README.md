<p align="center">
  <img src="https://miro.medium.com/max/800/1*VEVzcaiS3zd9nLnoBh9XPg.png" alt="Logo epayco" width="200px">
</p>

<p align="center">
<a href="https://packagist.org/packages/oscar-rey/laravel-epayco"><img src="https://img.shields.io/packagist/dt/oscar-rey/laravel-epayco" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/oscar-rey/laravel-epayco"><img src="https://img.shields.io/packagist/v/oscar-rey/laravel-epayco" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/oscar-rey/laravel-epayco"><img src="https://img.shields.io/packagist/l/oscar-rey/laravel-epayco" alt="License"></a>
 <a href="https://github.com/oscar-rey-mosquera/laravel-epayco/actions/workflows/test.yml"><img src="https://github.com/oscar-rey-mosquera/laravel-epayco/actions/workflows/test.yml/badge.svg" alt="Test"></a>
</p>

## 💻 Instalación

Para instalar utiliza [composer](https://getcomposer.org/).

```.bash  
composer require oscar-rey/laravel-epayco
```

## 🔧 Configuración

```bash
//.env
EPAYCO_PUBLIC_KEY=public_key
EPAYCO_PRIVATE_KEY=private_key
EPAYCO_P_KEY=p_key
```
## Helpers

```php
//instancia configurada de la clase Epayco\Epayco
epayco();

/**
* Verifica  el  signature de la request provenientes de epayco 
* epayco_check_webhook($request, $pkey = null)
*/
check_epayco_webhook($request->all());
```
## Usa el middleware en tu ruta de webhooks

```php
use LaravelEpayco\Http\Middleware\EpaycoCheckWebhookMiddleware;
 
Route::post('/davivienda/epayco/webhook', function () {
    //
})->middleware(EpaycoCheckWebhookMiddleware::class);
```

## Documentación

Este paquete es una envoltura del paquete epayco-php para laravel por ende la documentación es totalmente compatible con el uso de este [epayco-php-documentación](https://github.com/epayco/epayco-php).

## Contribución

Puedes contribuir agregando nuevas funcionalidades, actualizaciones,  refactorización de código y notificando errores, con antelación se agradece.

## License

[MIT license](LICENSE).
