<?php

namespace Omnipay\Easytransac\Message;

use Omnipay\Tests\TestCase;

class PurchaseResponseTest extends TestCase
{
    private $mockResponse = [
        "Code" => 0,
        "Signature" => "1f51786246a940677afe71f6968972fd46500bd1",
        "Result" => [
            "OperationType" => "payment",
            "PaymentMethod" => "Api",
            "ApplicationType" => "Api",
            "Tid" => "4bEp3k1v",
            "Uid" => "ccc",
            "OrderId" => "PO_123",
            "Status" => "captured",
            "Date" => "2018-08-06 10 =>54 =>18",
            "Amount" => 2.5,
            "ClientIP" => "22.22.22.22",
            "ClientIPCountry" => "USA",
            "Currency" => "EUR",
            "CurrencyText" => "Euro",
            "CurrencySymbol" => "€",
            "FixFees" => 0,
            "Message" => "La transaction a été capturée",
            "3DSecure" => "no",
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

    public function testPurchaseSuccess()
    {
        $response = new PurchaseResponse($this->getMockRequest(), $this->mockResponse);
        $this->assertEquals($response->getCode(), 0);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isCancelled());
        $this->assertEquals('4bEp3k1v', $response->getTransactionReference());
        $this->assertEquals('PO_123', $response->getTransactionId());
    }
}
