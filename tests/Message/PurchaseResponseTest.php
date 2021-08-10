<?php

namespace Omnipay\CreditCardPaymentProcessor\Message;

use Omnipay\Tests\TestCase;

class PurchaseResponseTest extends TestCase
{
    public function testPurchaseSuccess()
    {
        $response = new PurchaseResponse($this->getMockRequest(), array(
            'code' => 0
        ));
        //var_dump($response);

        $this->assertTrue($response->isSuccessful());
    }
}
