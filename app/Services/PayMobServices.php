<?php
namespace App\Services;
use Illuminate\Http\Client\Request ;
use Illuminate\Support\Facades\Http;
class PayMobServices {
    private $PAYMOB_API_KEY ;
    private $token ;
    private $id ;
    private $price;
    private $iframe_token;
    public function __construct($price)
    {
        $this->PAYMOB_API_KEY=env('PAYMOB_API_KEY');
        $this->token=false;
        $this->id=null;
        $this->price=$price;
        $this->iframe_token=null;
    }

    public function getToken()
    {
        $url="https://accept.paymobsolutions.com/api/auth/tokens";
        $response = Http::withHeaders(['content-type' => 'application/json'])->post($url, ["api_key" => $this->PAYMOB_API_KEY]);
        dd($response);
        if(isset($response->json()['token']))
        {
            $this->token= $response->json()['token'];
            return $response->json()['token'];

        }
        return false;
    }

    public function get_id()
    {
            $response_final = Http::withHeaders(['content-type' => 'application/json'])->post('https://accept.paymobsolutions.com/api/ecommerce/orders',
            ["auth_token" => $this->token, "delivery_needed" => "false", "amount_cents" => $this->price * 100, "items" => []]);
            if(isset($response_final->json()['id']))
            {
                $this->id=$response_final->json()['id'];
                return $this->id;
            }
    }

    public function make_order($user)
    {
        $url = "https://accept.paymobsolutions.com/api/acceptance/payment_keys";
        $response_final_final = Http::withHeaders(['content-type' => 'application/json'])->post($url, ["auth_token" => $this->token, "expiration" => 36000, "amount_cents" =>$this->price *100, "order_id" => $this->id, "billing_data" => ["apartment" => "NA", "email" => $user->email, "floor" => "NA",
        "first_name" => $user->name, "street" => "NA", "building" => "NA", "phone_number" => $user->phone??'', "shipping_method" => "NA", "postal_code" => "NA", "city" => "NA", "country" => "NA", "last_name" =>'NA', "state" => "NA"], "currency" => "EGP", "integration_id" => env('PAYMOB_MODE') == "live" ? env('PAYMOB_LIVE_INTEGRATION_ID') : env('PAYMOB_SANDBOX_INTEGRATION_ID') ]);
        if(isset($response_final_final->json()['token']))
        {
            $this->iframe_token = $response_final_final->json()['token'];
            return $this->iframe_token;
        }

    }



}
