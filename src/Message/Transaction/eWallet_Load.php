<?php

namespace Omnipay\iPayout\Message\Transaction;

class eWallet_Load extends AbstractRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'eWallet_Load';
    }

    public function sendData($data)
    {
        return $this->sendDataByClass($data, '\Omnipay\iPayout\Message\Response\LoadWalletStatusResponse');
    }
}

