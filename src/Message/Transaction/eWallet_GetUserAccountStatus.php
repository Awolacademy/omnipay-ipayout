<?php

namespace Omnipay\iPayout\Message\Transaction;
use Omnipay\iPayout\Message\AbstractRequest;

class eWallet_GetUserAccountStatus extends AbstractRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'eWallet_GetUserAccountStatus';
    }

    public function getData()
    {
        $data = $this->getBaseData();
        $data['UserName'] = $this->getUserName();
        return $data;
    }
    
    public function sendData($data)
    {
        return $this->sendDataByClass($data, '\Omnipay\iPayout\Message\Response\AccountStatusResponse');
    }
}

