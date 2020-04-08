<?php

namespace App\Services;

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
        try {
            $this->client = new PlacetoPay([
                'login' => config('payment.login'),
                'tranKey' => config('payment.trankey'),
                'url' => config('payment.endpoint')
            ]);
        } catch (PlacetoPayException $e) {
            return [
                'status' => Status::ST_FAILED,
            ];
        }
    }

    public function createPayment(PaymentRequest $request)
    {
        $response = $this->client->request($request->toArray());

        if ($response->isSuccessful()) {
            return [
                'status' => Status::ST_OK,
                'request' => $request,
                'response' => new PaymentResponse($response),
            ];
        }
        return [
            'status' => Status::ST_FAILED,
        ];
    }

    public function getInfoPayment($requestId)
    {
        $response = $this->client->query($requestId);

        if ($response->isSuccessful()) {
            return [
                'status' => Status::ST_OK,
                'response' => $response->status(),
            ];
        }
        return [
            'status' => Status::ST_FAILED,
        ];
    }
}
