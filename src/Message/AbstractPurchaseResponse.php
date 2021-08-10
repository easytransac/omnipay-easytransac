<?php

namespace Omnipay\CreditCardPaymentProcessor\Message;


use Omnipay\Common\Message\AbstractResponse;

abstract class AbstractPurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return $this->data->getStatusCode() == 200 && $this->data['Code'] == 0 && $this->data['Status'] == 'captured';
    }

    public function isRedirect()
    {
        return isset($this->data['SecureUrl']) ? true : false;
    }

    public function getRedirectUrl()
    {
        return isset($this->data['SecureUrl']) ? $this->data['SecureUrl'] : NULL;
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->getData();
    }
}
