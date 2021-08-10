<?php

/**
 * Created by xu
 * Date: 22/9/16
 * Time: 11:18 AM
 */

namespace Omnipay\CreditCardPaymentProcessor\Message;

use Omnipay\Tests\TestCase;

class CompletePurchaseRequestTest extends TestCase
{
    private CompletePurchaseRequest $request;
    private $options;

    public function setUp()
    {
        $this->request = new CompletePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
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
            'amount' => 76.10,
            'description' => 'Mini Bugatti',
            'transactionId' => 'PO_2021_05_121',
            'returnUrl' => 'https://www.example.com/return',
            'invoiceNo' => '20191212-123123',
            'clientIp' => '172.0.1.2',
            '3DS' => true,
        ];
    }

    public function testGetData()
    {
        $this->request->initialize($this->options);
        $result = $this->request->getData();
        $expected = [
            'Amount' => 7610,
            'CardNumber' => '4111111111111111',
            'CardYear' => 2022,
            'CardMonth' => 12,
            'CardCVV' => '123',
            'ClientIp' => '172.0.1.2',
            'OrderId' => 'PO_2021_05_121',
            'Description' => 'Mini Bugatti',
            'Email' => 'noreply@easytransac.com',
            'Firstname' => 'Cusfirstname',
            'Lastname' => 'Cuslastname',
            'Address' => '204 avenue de Colmar',
            'ZipCode' => '67000',
            'City' =>  'Strasbourg',
            'Country' =>  'France',
            'CallingCode' =>  '33',
            'Phone' => '0611223344',
            'BirthDate' => '1990-01-02',
            '3DS' => 'yes',
            'ReturnUrl' => 'https://www.example.com/return',
            'Signature' => '6e96dea74deaf203b4587f334f872d399ae40f42'
        ];

        $this->assertEquals($expected, $result);
    }

    public function testSendData()
    {
        $this->request->initialize($this->options);
        $this->assertInstanceOf(CompletePurchaseResponse::class, $this->request->sendData($this->request->getData()));
    }
}
