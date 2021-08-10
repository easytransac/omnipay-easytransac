<?php

namespace Omnipay\CreditCardPaymentProcessor\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected function getSignature(array $params)
    {
        if (isset($params['Signature'])) {
            unset($params['Signature']);
        }

        $chain = is_array($params) ? implode('$', $this->formatSignature($params)) : $params;
        return sha1($chain . '$' . $this->httpRequest->headers->get('EASYTRANSAC-API-KEY'));
    }

    public function formatSignature($params)
    {
        ksort($params);
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                ksort($value);
                $params[$key] = implode('$', $this->formatSignature($value));
            }
        }

        return $params;
    }

    public function getAmount()
    {
        return intval(round($this->getParameter('amount') * 100));
    }

    public function set3DS(bool $value)
    {
        $this->setParameter('3DS', $value ? 'yes' : 'no');
    }

    public function get3DS()
    {
        return $this->getParameter('3DS');
    }
}
