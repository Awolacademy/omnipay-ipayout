<?php

namespace Omnipay\iPayout\Message\Transaction;

class CreditRequest extends AuthorizeRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'credit';
    }
}
