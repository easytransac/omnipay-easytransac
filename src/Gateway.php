<?php

namespace Omnipay\CreditCardPaymentProcessor;

use Omnipay\Common\AbstractGateway;
use Omnipay\CreditCardPaymentProcessor\Message\CompletePurchaseRequest;
use Omnipay\CreditCardPaymentProcessor\Message\PurchaseRequest;

/**
 * Easytransac Gateway Driver for Omnipay
 *
 * This driver is based on Easytransac API documentation
 * @link https://www.easytransac.com/en/documentation
 */
class Gateway extends AbstractGateway
{

    public function getName()
    {
        return 'Easytransac Gateway';
    }

    public function getApiKey()
    {
        return $this->httpRequest->headers->get('EASYTRANSAC-API-KEY');
    }

    public function setApiKey(string $apiKey)
    {
        $this->httpRequest->headers->set('EASYTRANSAC-API-KEY', $apiKey);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest(CompletePurchaseRequest::class, $parameters);
    }
}
