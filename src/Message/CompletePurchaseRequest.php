<?php

namespace Omnipay\Nicepay\Message;

use Omnipay\Common\Exception\InvalidResponseException;

class CompletePurchaseRequest extends PurchaseRequest
{
    public function getData()
    {
        $txId = (string) $this->httpRequest->request->get('tXid');
        $amt = (string) $this->httpRequest->request->get('amt');
        $merchantToken = (string) $this->httpRequest->request->get('merchantToken');

        $signature = hash('sha256', $this->getImid().$txId.$amt.$this->getMerchantKey());
        if ($signature !== $merchantToken) {
            throw new InvalidResponseException("Invalid Signature");
        }

        return $this->httpRequest->request->all();
    }

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}