<?php

namespace Omnipay\Easytransac\Message;

class PurchaseRequest extends AbstractRequest
{
    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
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
            'CardNumber' => $this->getCard()->getNumber(),
            'CardYear' =>  $this->getCard()->getExpiryYear(),
            'CardMonth' => sprintf("%02d", $this->getCard()->getExpiryMonth()),
            'CardCVV' => $this->getCard()->getCvv(),
            'ReturnUrl' => $this->getReturnUrl(),
        ];

        // country are ISO3
        if ($this->getCard()->getCountry() !== null)
        {
            $data['Country'] = strtoupper($this->getCard()->getCountry());
            if (strlen($this->getCard()->getCountry()) > 3)
            {
                $data['Country'] = substr(strtoupper($this->getCard()->getCountry()), 0, 3);
            }
        }

        $data['Signature'] = $this->getSignature($data);
        $this->validate('amount', 'clientIp', 'card');

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/payment/direct';
    }
}
