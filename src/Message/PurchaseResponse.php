<?php

namespace Omnipay\CreditCardPaymentProcessor\Message;


use Omnipay\Common\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{
    public function getCode()
    {
        return isset($this->data['Code']) ? $this->data['Code'] : null;
    }

    public function isSuccessful()
    {
        if (isset($this->data['Code'])) {
            return $this->data['Code'] == 0 && $this->data['Result']['Status'] == 'captured';
        }

        return false;
    }

    public function isPending()
    {
        if (isset($this->data['Code'])) {
            return $this->data['Code'] == 0 && $this->data['Result']['Status'] == 'pending';
        }

        return false;
    }

    public function getMessage()
    {
        return isset($this->data['Result']['Message']) ? $this->data['Result']['Message'] : null;
    }

    public function isRedirect()
    {
        return isset($this->data['Result']['3DSecureUrl']);
    }

    public function getTransactionId()
    {
        return isset($this->data['Result']['OrderId']) ? $this->data['Result']['OrderId'] : null;
    }

    public function getTransactionReference()
    {
        return isset($this->data['Result']['Tid']) ? $this->data['Result']['Tid'] : null;
    }

    public function getRedirectUrl()
    {
        return isset($this->data['Result']['3DSecureUrl']) ? $this->data['Result']['3DSecureUrl'] : null;
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
