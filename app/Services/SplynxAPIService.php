<?php

namespace App\Services;

use App\Models\EasyPay;
use App\Models\Customer;
use App\DTO;
use Illuminate\Support\Facades\Http;

class SplynxAPIService
{
    //  Used for General GET Requests
    public function get(string $endpoint)
    {
        $splynxEndpoint = config('splynx.host');
        $response = Http::withHeaders([
            'Authorization' => $this->generateSignature(),
        ])->get("{$splynxEndpoint}/{$endpoint}");

        $responseData = $response->json();

        if ($response->successful()) {
            return [
                'success' => true,
                'data' => $responseData,
            ];
        }

        return [
            'success' => false,
            'data' => $responseData,
        ];
    }

    public function post(string $endpoint, array $payload)
    {
        $splynxHost = config('splynx.host');
        $url = $splynxHost . $endpoint;
        echo ("Splynx host: " . $url);

        $response = Http::withHeaders([
            'Authorization' => $this->generateSignature(),
        ])->post($url, $payload);

        echo ("post response" . $response);
        $responseData = $response->json();

        if ($response->successful()) {
            return [
                'success' => true,
                'data' => $responseData,
            ];
        }

        return [
            'success' => false,
            'data' => $response,
        ];
    }

    // public function checkStatus() : string {
    //    $response = Http::withHeaders([
    //         'Authorization' => $this->generateSignatureHeader(),
    //     ])->check($this->SplynxPluxnetEndpoint . '/api/check');
    // }

    /**
     * Generates Authentication Header for Requests
     * @return string
     */
    private function generateSignature(): string
    {
        $api_key = config('splynx.key');
        $api_secret = config('splynx.secret');

        $nonce = round(microtime(true) * 100);

        $signature = strtoupper(hash_hmac('sha256', $nonce . $api_key, $api_secret));

        $auth_data = array(
            'key' => $api_key,
            'signature' => $signature,
            'nonce' => $nonce++
        );

        $auth_string = http_build_query($auth_data);

        $signature = 'Splynx-EA (' . $auth_string . ')';
        return $signature;
    }

}
