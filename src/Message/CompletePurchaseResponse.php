<?php

namespace Omnipay\Nicepay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class CompletePurchaseResponse extends AbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        $this->data = $data;
    }

    public function isSuccessful()
    {
        return isset($this->data['status']) && '0' === $this->data['status'] || 0 === $this->data['status'];
    }

    public function getPayload()
    {
        return $this->data;
    }
}