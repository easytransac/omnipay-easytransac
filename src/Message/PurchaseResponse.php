<?php

namespace Omnipay\CreditCardPaymentProcessor\Message;


use Omnipay\Common\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return $this->data->getStatusCode() == 200 && $this->data['Code'] == 0 && $this->data['Status'] == 'captured';
    }

    public function isRedirect()
    {
        return true;
    }

    public function getTransactionId()
    {
        return $this->getData()['order_id'];
    }

    public function getRedirectUrl()
    {
        return 'https://www.easytransac.com/api/payment/direct';
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
