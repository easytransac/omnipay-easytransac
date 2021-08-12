<?php

namespace Omnipay\Easytransac;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    protected $gateway;

    /** @var array */
    private $options;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->options = [
            'card' => [
                'firstName' => 'Cusfirstname',
                'lastName' => 'Cuslastname',
                'email' => 'noreply@easytransac.com',
                'number' => '4111111111111111',
                'cvv' => '123',
                'expiryMonth' => '12',
                'expiryYear' => '22',
                'billingAddress1' => '204 avenue de Colmar',
                'billingCity' => 'Strasbourg',
                'billingPostcode' => '67000',
                'billingCountry' => 'France',
                'billingPhone' => '0611223344',
                'billingPhoneExtension' => '33',
                'birthday' => '1990-01-02',
            ],
            'amount' => 150.00,
            'description' => 'Mini Bugatti',
            'transactionId' => 'PO_2021_05_121',
            'returnUrl' => 'https://www.example.com/return',
            'invoiceNo' => '20191212-123123',
            'clientIp' => '172.0.1.2'
        ];
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase($this->options)->send();
        var_dump($response);

        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('https://www.easytransac.com/api/payment/direct', $response->getRedirectUrl());
    }
}
