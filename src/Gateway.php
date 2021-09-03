<?php

namespace Omnipay\Easytransac;

use Omnipay\Easytransac\Message\PurchaseRequest;

/**
 * Easytransac Gateway Driver for Omnipay
 * @see \Omnipay\Easytransac\AbstractGateway
 * This driver is based on Easytransac API documentation
 * @link https://www.easytransac.com/en/documentation
 */
class Gateway extends AbstractGateway
{
    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'Easytransac';
    }

    /**
     * @inheritdoc
     * @return PurchaseRequest
     */
    public function purchase(array $parameters = array()): PurchaseRequest
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     * @inheritdoc
     * @return PurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    public function refund()
    {
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
    }
}
