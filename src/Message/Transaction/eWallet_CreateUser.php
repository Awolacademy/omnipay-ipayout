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

    public function getData()
    {
        $eWallet = $this->getEwallet();
        $eWallet->validate();
        
        $data = $this->getBaseData();
        $data['FirstName'] = $eWallet->getFirstName();
        return $data;
    }
}

