<?php

namespace App\Services;

use App\Entities\Payment;
use App\Services\Structure\PaymentRequest;
use App\Services\Structures\PaymentResponse;
use Dnetix\Redirection\Entities\Status;
use Dnetix\Redirection\Exceptions\PlacetoPayException;
use Dnetix\Redirection\PlacetoPay;

class PaymentService
{
    public $settings;

    public $client;

    public $response;

    public function __construct()
    {
        $this->settings = [
            'login'   => config('payment.login'),
            'tranKey' => config('payment.trankey'),
            'url'     => config('payment.endpoint')
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
            'login'   => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url'     => 'https://test.placetopay.com/redirection',
        ]);

        $this->response = $this->client->request($request->toArray());

        if ($this->response->isSuccessful()) {

            return [
                'status'   => Status::ST_OK,
                'request'  => $request,
                'response' => new PaymentResponse($this->response),
            ];
        } else {

            return [
                'status' => Status::ST_FAILED,
            ];
        }
    }


}
