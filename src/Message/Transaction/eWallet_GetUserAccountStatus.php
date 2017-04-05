<?php

namespace Omnipay\iPayout\Message\Transaction;

class eWallet_GetUserAccountStatus extends AbstractRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'accountstatus';
    }
}

