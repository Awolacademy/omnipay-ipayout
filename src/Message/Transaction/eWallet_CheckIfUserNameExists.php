<?php

namespace Omnipay\iPayout\Message\Transaction;

class eWallet_CheckIfUserNameExists extends AbstractRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'userexists';
    }
}

