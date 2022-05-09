<?php
namespace App\Services;
use App\ModelTax;
use GuzzleHttp\Client;
use Illuminate\Database\Eloguent\Model;
use GuzzleHttp\Psr7\Request;
class FatoorahServices{
    private $base_url;
    private $headers;
    private $request_client;

    public function __construct(Client $request_client){
       $this->request_client = $request_client;
       $this->base_url =env('fatoora_base_url','https://apitest.myfatoorah.com/');
       $this->headers= [
           "Content-Type" =>'application/json',
           "authorization" => 'Bearer '.env("fatoora_token","rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL")
       ];
    }

    public function buildRequest($url,$mothod, $data =[]){
        $request = new Request($mothod , $this->base_url.$url, $this->headers);
        if (!$data)
            return false;
        $response = $this->request_client->send($request, ['json'=>$data]);
        if ($response->getStatusCode() != 200)
            return false;
        $response = json_decode ($response->getBody (),true);
        return $response;
    }

    public function sendPayment($data){
        $response  = $this->buildRequest('v2/SendPayment','POST', $data);
        return $response;
    }
    public function getPaymentStatus($data){
        $response  = $this->buildRequest('v2/getPaymentStatus','POST', $data);
        return $response;
    }

    function callAPI($endpointURL, $apiKey, $postFields = []) {
        $curl = curl_init($endpointURL);
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => json_encode($postFields),
            CURLOPT_HTTPHEADER     => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));
        $response = curl_exec($curl);
        $curlErr  = curl_error($curl);
        curl_close($curl);
        return $response;
    }

}

?>
