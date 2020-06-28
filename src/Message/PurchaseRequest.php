<?php

namespace Omnipay\Nicepay\Message;

use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://www.nicepay.co.id/nicepay/api/orderRegist.do';
    protected $testEndpoint = 'https://dev.nicepay.co.id/nicepay/api/orderRegist.do';

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

    public function getPayMethod()
    {
        return $this->getParameter('payMethod');
    }

    public function setPayMethod($value)
    {
        return $this->setParameter('payMethod', $value);
    }

    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }

    public function getCartData()
    {
        return $this->getParameter('cartData');
    }

    public function setCartData($value)
    {
        return $this->setParameter('cartData', $value);
    }

    public function getGoodsNm()
    {
        return $this->getParameter('goodsNm');
    }

    public function setGoodsNm($value)
    {
        return $this->setParameter('goodsNm', $value);
    }

    public function getCallBackUrl()
    {
        return $this->getParameter('callBackUrl');
    }

    public function setCallBackUrl($value)
    {
        return $this->setParameter('callBackUrl', $value);
    }

    public function getDbProcessUrl()
    {
        return $this->getParameter('dbProcessUrl');
    }

    public function setDbProcessUrl($value)
    {
        return $this->setParameter('dbProcessUrl', $value);
    }

    public function getUserIP()
    {
        return $this->getParameter('userIP');
    }

    public function setUserIP($value)
    {
        return $this->setParameter('userIP', $value);
    }

    public function getDescription()
    {
        return $this->getParameter('description');
    }

    public function setDescription($value)
    {
        return $this->setParameter('description', $value);
    }

    public function getBillingNm()
    {
        return $this->getParameter('billingNm');
    }

    public function setBillingNm($value)
    {
        return $this->setParameter('billingNm', $value);
    }

    public function getBillingPhone()
    {
        return $this->getParameter('billingPhone');
    }

    public function setBillingPhone($value)
    {
        return $this->setParameter('billingPhone', $value);
    }

    public function getBillingEmail()
    {
        return $this->getParameter('billingEmail');
    }

    public function setBillingEmail($value)
    {
        return $this->setParameter('billingEmail', $value);
    }

    public function getBillingCity()
    {
        return $this->getParameter('billingCity');
    }

    public function setBillingCity($value)
    {
        return $this->setParameter('billingCity', $value);
    }

    public function getBillingState()
    {
        return $this->getParameter('billingState');
    }

    public function setBillingState($value)
    {
        return $this->setParameter('billingState', $value);
    }

    public function getBillingPostCd()
    {
        return $this->getParameter('billingPostCd');
    }

    public function setBillingPostCd($value)
    {
        return $this->setParameter('billingPostCd', $value);
    }

    public function getBillingCountry()
    {
        return $this->getParameter('billingCountry');
    }

    public function setBillingCountry($value)
    {
        return $this->setParameter('billingCountry', $value);
    }

    public function getMerFixAcctId()
    {
        return $this->getParameter('merFixAcctId');
    }

    public function setMerFixAcctId($value)
    {
        return $this->setParameter('merFixAcctId', $value);
    }

    public function getInstmntType()
    {
        return $this->getParameter('instmntType');
    }

    public function setInstmntType($value)
    {
        return $this->setParameter('instmntType', $value);
    }

    public function getInstmntMon()
    {
        return $this->getParameter('instmntMon');
    }

    public function setInstmntMon($value)
    {
        return $this->setParameter('instmntMon', $value);
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function sendData($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->getEndpoint(),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "gzip",
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => http_build_query($data),
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));

        $response = curl_exec($curl);

        // temp
        $response = str_replace('0277', '', $response);

        $response = json_decode($response, true);

        return new PurchaseResponse($this, $response);
    }

    public function getData()
    {
        $data = array();
        $data['iMid'] = $this->getImid();
        $data['merchantToken'] = $this->getMerchantToken();
        $data['payMethod'] = $this->getPayMethod();
        $data['currency'] = $this->getCurrency();
        $data['amt'] = $this->getAmt();
        $data['cartData'] = $this->getCartData();
        $data['referenceNo'] = $this->getReferenceNo();
        $data['goodsNm'] = $this->getGoodsNm();
        $data['callBackUrl'] = $this->getCallBackUrl();
        $data['dbProcessUrl'] = $this->getDbProcessUrl();
        $data['userIP'] = $this->getUserIP();
        $data['description'] = $this->getDescription();
        $data['billingNm'] = $this->getBillingNm();
        $data['billingPhone'] = $this->getBillingPhone();
        $data['billingEmail'] = $this->getBillingEmail();
        $data['billingCity'] = $this->getBillingCity();
        $data['billingState'] = $this->getBillingState();
        $data['billingPostCd'] = $this->getBillingPostCd();
        $data['billingCountry'] = $this->getBillingCountry();
        if ($this->getPayMethod() == '01') {
            $data['instmntType'] = $this->getInstmntType();
            $data['instmntMon'] = $this->getInstmntMon();
        }

        return $data;
    }
}
