<?php

namespace Omnipay\iPayout\Message\Transaction;
use Omnipay\iPayout\Message\AbstractRequest;

class eWallet_Load extends AbstractRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'eWallet_Load';
    }
    public function getData()
    {
        $data = $this->getBaseData();
        $comments = "Commissions Paid on: ".date("m/d/Y");
        $data['PartnerBatchID'] = $comments;
        $data['arrAccounts'] = array('UserName' => $this->getUserName(),
                                     'Amount'   => $this->getAmount(),
                                     'Comments' => $comments. "AffilateID: ",
                                     'MerchantReferenceID' =>  '$this->getMerchantReferenceID()');
        $data['AllowDuplicates'] = true;
        $data['AutoLoad'] = false;
        $data['CurrencyCode'] = "USD";
        return $data;
    }

    public function sendData($data)
    {
        return $this->sendDataByClass($data, '\Omnipay\iPayout\Message\Response\LoadWalletStatusResponse');
    }
}

