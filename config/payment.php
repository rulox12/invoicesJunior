<?php

return [
    'return_url' => env('PAYMENT_RETURN_URL','http://127.0.0.1:8000/payments/returnURL/'),
    'login' => env('PAYMENT_LOGIN','6dd490faf9cb87a9862245da41170ff2'),
    'trankey' => env('PAYMENT_TRANKEY','024h1IlD'),
    'endpoint' => env('PAYMENT_ENDPOINT','https://test.placetopay.com/redirection'),

];
