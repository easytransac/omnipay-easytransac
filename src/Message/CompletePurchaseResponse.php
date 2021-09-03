<?php

namespace Omnipay\Easytransac\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class CompletePurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful(): bool
    {
        return $this->data['Status'] == 'captured';
    }

    public function isRedirect(): bool
    {
        return false;
    }

    public function isPending(): bool
    {
        return $this->data['Status'] == 'pending';
    }

    public function isCancelled(): bool
    {
        return $this->data['Status'] == 'canceled';
    }

    public function getMessage()
    {
        return $this->data['Message'];
    }

    public function getRedirectUrl()
    {
        return null;
    }

    public function getRedirectData(): array
    {
        return array();
    }

    public function getTransactionReference()
    {
        return $this->data['Tid'];
    }
}
