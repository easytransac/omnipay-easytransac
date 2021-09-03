<?php

namespace Omnipay\Easytransac\Message;

use Omnipay\Stripe\Message\Response;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $endpoint = 'https://www.easytransac.com/api';

    abstract public function getEndpoint();

    public function getHttpMethod()
    {
        return 'POST';
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey(string $value)
    {
        return $this->setParameter('apiKey', $value);
    }

    // generate signature within the given params
    protected function getSignature(array $params): string
    {
        if (isset($params['Signature'])) {
            unset($params['Signature']);
        }

        $chain = is_array($params) ? implode('$', $this->formatSignature($params)) : $params;
        return sha1($chain . '$' . $this->httpRequest->headers->get('EASYTRANSAC-API-KEY'));
    }

    // order params
    private function formatSignature($params)
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

    public function get3DS(): string
    {
        return $this->getParameter('3DS') ?? 'yes';
    }

    public function sendData($data)
    {
        $headers = [
            'EASYTRANSAC-API-KEY' => $this->getApiKey(),
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $httpResponse = $this->httpClient->request($this->getHttpMethod(), $this->getEndpoint(), $headers, http_build_query($data));
        return $this->createResponse($httpResponse->getBody()->getContents());
    }

    protected function createResponse($data): PurchaseResponse
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
