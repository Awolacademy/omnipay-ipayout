<?php

namespace Omnipay\iPayout\Message\Transaction;

use Omnipay\iPayout\Message\AbstractRequest;

class eWallet_CheckIfUserNameExists extends AbstractRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'eWallet_CheckIfUserNameExists';
    }

    public function getData()
    {
        $data = $this->getBaseData();
        $data['UserName'] = $this->getUserName();
        return $data;
    }
}

