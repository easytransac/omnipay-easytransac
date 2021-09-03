<?php

namespace Omnipay\Easytransac\Message;

class CompletePurchaseRequest extends \Omnipay\Common\Message\AbstractRequest
{
    public function getData(): array
    {
        // we return all the request parameters
        return $this->httpRequest->request->all();
    }

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
