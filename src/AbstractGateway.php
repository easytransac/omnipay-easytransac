<?php

namespace Omnipay\Easytransac;

use Omnipay\Common\AbstractGateway as AbstractOmnipayGateway;

/**
 * Easytransac Gateway Driver for Omnipay
 *
 * This driver is based on Easytransac API documentation
 * @link https://www.easytransac.com/en/documentation
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 */
abstract class AbstractGateway  extends AbstractOmnipayGateway
{
    /**
     * @inheritdoc
     */
    abstract public function getName();

    /**
     * Get the gateway parameters.
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'apiKey' => '',
        );
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }
    /**
     * Set the gateway API Key.
     * Setting the testMode flag on this gateway has no effect.  To
     * use test mode just use your test mode API key.
     *
     * @param string $value
     * @return Gateway provides a fluent interface.
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    abstract public function purchase(array $parameters = array());

    abstract public function completePurchase(array $parameters = array());

    abstract public function refund();
}
