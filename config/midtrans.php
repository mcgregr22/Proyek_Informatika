<?php

return [
    'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
    'client_key'  => env('MIDTRANS_CLIENT_KEY'),
    'server_key'  => env('MIDTRANS_SERVER_KEY'),

    'is_production' => false, // masih sandbox
    'is_sanitized'  => true,
    'is_3ds'        => true,

//     'curl_options' => [
//     CURLOPT_CAINFO => base_path('cacert.pem'),
//     CURLOPT_CAPATH => base_path()
// ],

];
