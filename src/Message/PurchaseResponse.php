<?php

namespace Omnipay\Nicepay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function __construct(RequestInterface $request, $data)
    {
        $this->data = $data;
    }

    public function isSuccessful()
    {
        return isset($this->data['data']['resultCd']) && '0000' === $this->data['data']['resultCd'];
    }

    public function isRedirect()
    {
        return isset($this->data['data']['resultCd']) && '0000' === $this->data['data']['resultCd'];
    }

    public function getRedirectUrl()
    {
        return (isset($this->data['data']['resultCd']) && '0000' === $this->data['data']['resultCd']) ? $this->data['data']['requestURL'].'?tXid='.$this->data['data']['tXid'].'&optDisplayCB=1&optDisplayBL=0' : null;
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getApiResponse()
    {
        return $this->data;
    }
}
