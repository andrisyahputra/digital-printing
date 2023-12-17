<?php

return [
    'merchant_id' => env('MIDTRANS_ID_MERCHANT'),
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'snap_url' => env('MIDTRANS_SNAP_URL'),
    'is_production' => env('IS_PRODUCTION'),
];
