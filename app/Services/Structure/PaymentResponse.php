<?php

namespace App\Services\Structures;

use Dnetix\Redirection\Entities\Status;

class PaymentResponse
{
    private $requestId;
    private $processUrl;

    public $response;

    public function __construct($data)
    {
        $this->requestId = $data->requestId;
        $this->processUrl = $data->processUrl;

        $this->response = $data;
    }

    public function getUrl()
    {
        return $this->processUrl;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }

    public function getStatusOk()
    {
        return $this->response->isSuccessful();
    }

    public static function fromError($message = '')
    {
        return new static([
            'status' => [
                'status'  => 'ER',
                'message' => $message,
                'reason'  => 'XX',
                'date'    => date('c'),
            ],
        ]);
    }
}
