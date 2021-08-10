<?php

namespace Omnipay\CreditCardPaymentProcessor\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $data = [
            'Amount' => $this->getAmount(),
            'ClientIp' => $this->getClientIp(),
            'OrderId' => $this->getTransactionId(),
            'Description' => $this->getDescription(),
            'Firstname' => $this->getCard()->getFirstName(),
            'Lastname' =>  $this->getCard()->getLastName(),
            'Email' =>  $this->getCard()->getEmail(),
            'Address' => $this->getCard()->getBillingAddress1(),
            'ZipCode' => $this->getCard()->getBillingPostcode(),
            'City' => $this->getCard()->getCity(),
            'Country' => $this->getCard()->getCountry(),
            'CallingCode' => $this->getCard()->getBillingPhoneExtension(),
            'Phone' => $this->getCard()->getBillingPhone(),
            'BirthDate' => $this->getCard()->getBirthday('Y-m-d'),
            '3DS' => $this->get3DS(),
            'ReturnUrl' => $this->getReturnUrl(),
            'CardNumber' => $this->getCard()->getNumber(),
            'CardYear' =>  $this->getCard()->getExpiryYear(),
            'CardMonth' => $this->getCard()->getExpiryMonth(),
            'CardCVV' => $this->getCard()->getCvv(),
            'ReturnUrl' => $this->getReturnUrl(),
        ];

        $data['Signature'] = $this->getSignature($data);
        $this->validate('amount', 'clientIp', 'card');

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
