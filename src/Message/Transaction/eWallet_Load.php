<?php

namespace Omnipay\iPayout\Message\Transaction;

class eWallet_Load extends AbstractRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'loadwallet';
    }
}

