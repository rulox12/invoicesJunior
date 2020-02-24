<?php

namespace App\Services\Structures;

use Dnetix\Redirection\Entities\Status;

class PaymentResponse
{
    /** @var Status $status */
    public $status;


    public function __construct(array $data)
    {
        $this->init($data);
    }

    private function init($data)
    {
        $statusFields = [
            'status', 'message', 'reason', 'date',
        ];

        if (!array_key_exists('status', $data)) {
            throw new InvalidServiceResponse(sprintf('Service response without status'));
        }

        foreach ($statusFields as $field) {
            if (!array_key_exists($field, $data['status'])) {
                throw new InvalidServiceResponse(sprintf('Status incomplete, "%s" not found', $field));
            }
        }

        $this->status = new Status($data['status']);
    }

    public function isSuccessFul()
    {
        if (is_null($this->status)) {
            return false;
        }

        return $this->status->isSuccessful();
    }

    public static function fromError($message = '')
    {
        return new static([
            'status' => [
                'status' => 'ER',
                'message' => $message,
                'reason' => 'XX',
                'date' => date('c'),
            ],
        ]);
    }
}
