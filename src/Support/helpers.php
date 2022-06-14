<?php

use Epayco\Epayco;

if (!function_exists("epayco")) {

    /**
     * @return Epayco
     */
    function epayco()
    {
        return app(Epayco::class);
    }
}


if (!function_exists("epayco_check_response")) {

    /**
     * @param string|null $pkey
     * @param array $request 
     * @return bool
     */
    function epayco_check_webhook($request, $pkey = null)
    {
        try {
            $p_cust_id_cliente = $request['x_cust_id_cliente'];
            $p_key = $p_key ?? config("laravel-epayco.p_key");
            $ref_epayco = $request['x_ref_payco'];
            $transaction_id = $request['x_transaction_id'];
            $amount = $request['x_amount'];
            $currency_code  = $request['x_currency_code'];
            $request_signature = $request['x_signature'];

            $signature = hash('sha256', $p_cust_id_cliente . '^' . $p_key . '^' . $ref_epayco . '^' . $transaction_id . '^' . $amount . '^' . $currency_code);

            return $signature === $request_signature;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
