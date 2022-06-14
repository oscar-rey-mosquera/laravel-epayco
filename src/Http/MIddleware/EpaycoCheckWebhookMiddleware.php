<?php
namespace LaravelEpayco\Http\MIddleware;

use Closure;

class EpaycoCheckWebhookMiddleware
{
    public function handle($request, Closure $next)
    {
       if(!epayco_check_webhook($request->all())) {
           return false;
         }
        return $next($request);
    }
}