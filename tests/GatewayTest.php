<?php

namespace Omnipay\Nicepay;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $ref = md5('order_'.microtime());
        $iMid = 'IONPAYTEST';
        $amt = '69000';
        $key = '33F49GnCMS1mFYlGXisbUDzVf2ATWCl9k3R++d5hDd3Frmuos/XLx8XhXpe+LDYAbpGKZYSwtlyyLOtS/8aD7A==';

        $this->purchaseOptions = array(
            'testMode' => true,
            'iMid' => $iMid,
            'referenceNo' => $ref,
            'amt' => $amt,
            'merchantKey' => $key,
            'payMethod' => '02',
            'currency' => 'IDR',
            'cartData' => '{}',
            'goodsNm' => 'Test Transaction Nicepay',
            'callBackUrl' => 'https://webhook.site/8af0cc1f-c116-481e-93e3-2e54b94027fe',
            'dbProcessUrl' => 'https://webhook.site/8af0cc1f-c116-481e-93e3-2e54b94027fe',
            'userIP' => '127.0.0.1',
            'description' => 'Payment of Invoice No '.$ref,
            'billingNm' => 'John Doe',
            'billingPhone' => '02112345678',
            'billingEmail' => 'david@avana.id',
            'billingCity' => 'Jakarta Pusat',
            'billingState' => 'DKI Jakarta',
            'billingPostCd' => '10210',
            'billingCountry' => 'Indonesia',
        );

        $this->completePurchaseOptions = array(
            'iMid' => $iMid,
            'merchantKey' => $key,
        );
    }
    
    /**
     *@group testPurchase
     */
    public function testPurchase()
    {
        $response = $this->gateway->purchase($this->options)->send();
        // error_log(print_r($response->getRedirectUrl(), TRUE), 3, "/home/videk/www/contrib/omnipay-nicepay/error.log");

        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
    }

    /**
     *@group testCompletePurchaseSuccess
     */
    public function testCompletePurchaseSuccess()
    {
        $this->getHttpRequest()->request->replace(
            array(
                'merchantToken' => 'ed06857074f838fa8c6effcc6d90f4e0cbc143bd8ac08b29e8785b042f3766c7',
                'tXid' => 'IONPAYTEST02202006280209483703',
                'amt' => '69000',
                'status' => 0,
            )
        );

        $response = $this->gateway->completePurchase($this->completePurchaseOptions)->send();
        // error_log(print_r($response->getPayload(), TRUE), 3, "/home/videk/www/contrib/omnipay-nicepay/error.log");

        $this->assertTrue($response->isSuccessful());
    }
}
