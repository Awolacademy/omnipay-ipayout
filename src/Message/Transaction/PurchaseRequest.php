<?php

namespace Omnipay\iPayout\Message\Transaction;

class PurchaseRequest extends AuthorizeRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'sale';
    }
}
