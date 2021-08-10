<?php

/**
 * Created by xu
 * Date: 22/9/16
 * Time: 11:44 AM
 */

namespace Omnipay\CreditCardPaymentProcessor\Message;


use Omnipay\Tests\TestCase;

class RedirectCompletePurchaseResponseTest extends TestCase
{
    public function setUp()
    {
        $this->data  = [
            "Code" => 0,
            "Signature" => "1f51786246a940677afe71f6968972fd46500bd1",
            "Result" => [
                "3DSecureUrl" => "https://www.easytransac.com/api/payment/3dsecure/a1b2c3d4",
                "OperationType" => "payment",
                "PaymentMethod" => "Api",
                "ApplicationType" => "Api",
                "Tid" => "4bEp3k1v",
                "Uid" => "ccc",
                "OrderId" => "PO_123",
                "Status" => "pending",
                "Date" => "2018-08-06 10 =>54 =>18",
                "Amount" => 2.5,
                "ClientIP" => "22.22.22.22",
                "ClientIPCountry" => "USA",
                "Currency" => "EUR",
                "CurrencyText" => "Euro",
                "CurrencySymbol" => "€",
                "FixFees" => 0,
                "Message" => "La transaction est en cours",
                "3DSecure" => "yes",
                "OneClick" => "yes",
                "Alias" => "Xagv6r",
                "CardNumber" => "************6629",
                "CardMonth" => 1,
                "CardYear" => 2025,
                "CardType" => "MASTERCARD",
                "CardCountry" => "FRA",
                "Test" => "yes",
                "Language" => "FRE",
                "Error" => "",
                "AdditionalError" => [],
                "Client" => [
                    "Id" => "aaabbb1",
                    "Email" => "test@test.com",
                    "Firstname" => "John",
                    "Lastname" => "Doe",
                    "Address" => "26 green street",
                    "ZipCode" => 75001,
                    "City" => "Paris"
                ]
            ]
        ];
    }

    public function testPurchasePending()
    {
        $response = new PurchaseResponse($this->getMockRequest(), $this->data);

        $this->assertTrue($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('https://www.easytransac.com/api/payment/3dsecure/a1b2c3d4', $response->getRedirectUrl());
        $this->assertEquals('4bEp3k1v', $response->getTransactionReference());
        $this->assertEquals('PO_123', $response->getTransactionId());
        $this->assertFalse($response->isTransparentRedirect());
    }

    public function testPurchaseFailed()
    {
        $this->data['Status'] = 'failed';
        $response = new PurchaseResponse($this->getMockRequest(), $this->data);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertEquals('4bEp3k1v', $response->getTransactionReference());
        $this->assertEquals('PO_123', $response->getTransactionId());
        $this->assertFalse($response->isTransparentRedirect());
    }
}
