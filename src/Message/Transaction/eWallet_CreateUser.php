<?php

namespace Omnipay\iPayout\Message\Transaction;

class CreateUser extends AbstractRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'createuser';
    }
}

