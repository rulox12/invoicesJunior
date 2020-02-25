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
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection',
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
        $this->client = new PlacetoPay([
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection',
        ]);
        $response = $this->client->request($request->toArray());

        if ($response->isSuccessful()) {
            // In order to use the functions please refer to the Dnetix\Redirection\Message\RedirectInformation class
            dd(dd($response));
            if ($response->status()->isApproved()) {
                dd($response);
            }
        } else {
            // There was some error with the connection so check the message
            print_r($response->status()->message() . "\n");
        }
    }





}
