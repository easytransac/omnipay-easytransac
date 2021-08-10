<?php

namespace Omnipay\CreditCardPaymentProcessor\Message;

class CompletePurchaseRequest extends PurchaseRequest
{
    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
