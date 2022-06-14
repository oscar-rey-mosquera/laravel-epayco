<?php

namespace LaravelEpayco\Tests;

use Illuminate\Http\Request;
use LaravelEpayco\Facades\EpaycoFacade;
use LaravelEpayco\Http\MIddleware\EpaycoCheckWebhookMiddleware;

class EpaycoTest extends TestCase
{
  /**
   * @test
   */
  public function probar_wrapper_para_laravel()
  {

    $card = epayco()->token->create([
      "card[number]" => '4575623182290326',
      "card[exp_year]" => "2017",
      "card[exp_month]" => "07",
      "card[cvc]" => "123"
    ]);

    $customer = epayco()->customer->create(array(
      "token_card" => $card->id,
      "name" => "Joe",
      "last_name" => "Doe", //This parameter is optional
      "email" => "joe@payco.co",
      //Optional parameters: These parameters are important when validating the credit card transaction
      "city" => "Bogota",
      "address" => "Cr 4 # 55 36",
      "phone" => "3005234321",
      "cell_phone" => "3010000001",
    ));  

    $this->assertNotNull($card->id);
    $this->assertNotNull($customer->data->customerId);
  }

  public function check_middleware() {
    list($data, $badData) = $this->web_hook_data();
    $request = new Request($data);

    (new EpaycoCheckWebhookMiddleware())->handle($request, function ($request) use($data) {
      $this->assertEquals($data['x_cust_id_cliente'], $request['x_cust_id_cliente']);

      return true;
    });


    $request = new Request($badData);

   $response = (new EpaycoCheckWebhookMiddleware())->handle($request, function ($request){});

   $this->assertFalse($response);


  }


  public function web_hook_data() {
    return [
      [
        'x_cust_id_cliente' => 644328,
        'x_ref_payco' => 92639999,
        'x_transaction_id' => 92639999,
        'x_amount' => 116000,
        'x_currency_code' => 'COP',
        'x_signature' => 'fb01a6ae5108bdaa5e4d2683f28f87297c69df3aabdc89dab46abf79a377d375'
      ],
      [
        'x_cust_id_cliente' => 644388,
        'x_ref_payco' => 92639999,
        'x_transaction_id' => 92639899,
        'x_amount' => 116000,
        'x_currency_code' => 'COP',
        'x_signature' => 'fb01a6ae5108bdaa5e4d2683f28f87297c69df3aabdc89dab46abf79a377d375'
      ]
    ];
  }
}
