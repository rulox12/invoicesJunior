<?php

namespace App\Services;

use App\Services\Structure\PaymentRequest;
use App\Services\Structures\PaymentResponse;
use Dnetix\Redirection\Exceptions\PlacetoPayException;
use Dnetix\Redirection\PlacetoPay;

class PaymentService
{
    public $settings;

    public $client;

    public function __construct()
    {
        $this->settings = [
            config('payment.login') => '',
            config('payment.trankey') => '',
            config('url') => ''
        ];

        try {
            $this->client = new PlacetoPay([
                $this->settings
            ]);
        } catch (PlacetoPayException $e) {
        }
    }

    public function createPayment(PaymentRequest $request)
    {
        dd($request);
        $this->client->request($request->toArray());
    }





}
