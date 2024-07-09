<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private $client;
    private $client_id;
    private $client_secret;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api-m.sandbox.paypal.com',
        ]);
        $this->client_id = env('PAYPAL_CLIENT_ID');
        $this->client_secret = env('PAYPAL_CLIENT_SECRET');
    }

    private function getAccessToken()
    {
        try {
            $response = $this->client->request('POST', "/v1/oauth2/token", [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => "application/x-www-form-urlencoded",
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ],
                'auth' => [
                    $this->client_id, $this->client_secret, 'basic'
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['access_token'];
        } catch (\Exception $e) {
            Log::error('Error getting PayPal access token: ' . $e->getMessage());
            return null;
        }
    }

    public function process($orderId)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return response()->json(['error' => 'Unable to obtain access token'], 500);
        }
        try {
            $response = $this->client->request('GET', '/v2/checkout/orders/' . $orderId, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer $accessToken"
                ]
            ]);
            $data = json_decode($response->getBody(), true);
            if ($data['STATUS'] === 'APROVED') {
                # code...
            }
            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Error processing PayPal order: ' . $e->getMessage());
            return response()->json(['error' => 'Error processing order'], 500);
        }
    }
}
