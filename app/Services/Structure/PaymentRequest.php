<?php

namespace App\Services\Structure;

class PaymentRequest
{
    private $reference;

    private $document;

    private $amount;

    private $expiration;

    private $returnUrl;

    private $ipAddress;

    private $userAgent;

    public function __construct(
        int $reference,
        string $document,
        float $amount,
        int $description
    )
    {
        $this->reference = $reference;
        $this->document = $document;
        $this->description = $description;
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getExpirationDate()
    {
        return date('c', strtotime('+2 days'));
    }

    /**
     * @return mixed
     */
    public function getReturUrl()
    {
        return config('payment.return_url');
    }

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    /**
     * @return mixed
     */
    public function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'payment' => [
                'reference' => $this->reference,
                'description' => $this->description,
                'amount' => [
                    'currency' => 'COP',
                    'total' => $this->amount,
                ],
            ],
            'expiration' => $this->getExpirationDate(),
            'returnUrl' => $this->getReturUrl() . $this->reference,
            'ipAddress' => $this->getIpAddress(),
            'userAgent' => $this->getUserAgent()
        ];
    }
}
