<?php

namespace Omnipay\Nicepay;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Nicepay';
    }

    public function getDefaultParameters()
    {
        return [
            'iMid' => '',
            'merchantKey' => ''
        ];
    }

    public function getImid()
    {
        return $this->getParameter('iMid');
    }

    public function setImid($value)
    {
        return $this->setParameter('iMid', $value);
    }

    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }

    public function setMerchantKey($value)
    {
        return $this->setParameter('merchantKey', $value);
    }

    public function getReferenceNo()
    {
        return $this->getParameter('referenceNo');
    }

    public function setReferenceNo($value)
    {
        return $this->setParameter('referenceNo', $value);
    }

    public function getAmt()
    {
        return $this->getParameter('amt');
    }

    public function setAmt($value)
    {
        return $this->setParameter('amt', $value);
    }

    public function getMerchantToken()
    {
        return hash('sha256', $this->getParameter('iMid').$this->getParameter('referenceNo').$this->getParameter('amt').$this->getParameter('merchantKey'));
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Nicepay\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Nicepay\Message\CompletePurchaseRequest', $parameters);
    }
}
