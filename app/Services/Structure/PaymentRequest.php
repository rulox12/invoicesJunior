<?php

namespace App\Services\Structure;

class PaymentRequest
{
    private $reference;

    private $customer;

    private $amount;

    private $description;

    private $expiration;

    private $returnUrl;

    private $ipAddress;

    private $userAgent;

    private $paymentConcept;

    public function __construct($data)
    {
        $this->paymentConcept = $data['reference'];
        $this->reference = time() . '-' . $data['reference'];
        $this->customer = $data['customer'];
        $this->description = $data['description'];
        $this->amount = $data['amount'];
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
    public function getDescription()
    {
        return $this->description;
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
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * @return mixed
     */
    public function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * @return mixed
     */
    public function getPaymentConcept()
    {
        return $this->paymentConcept;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'buyer' => array(
                'name' => $this->customer->name,
                'surname' => $this->customer->surname,
                'type_document' => $this->customer->type_document,
                'document' => $this->customer->document,
            ),
            'payment' => array(
                'reference' => $this->getReference(),
                'description' => $this->description,
                'amount' => array(
                    'currency' => 'COP',
                    'total' => $this->amount,
                ),
            ),
            'expiration' => $this->getExpirationDate(),
            'returnUrl' => $this->getReturUrl() . $this->getReference(),
            'ipAddress' => $this->getIpAddress(),
            'userAgent' => $this->getUserAgent(),
            'payment_concept' => $this->getPaymentConcept()
        );
    }
}
