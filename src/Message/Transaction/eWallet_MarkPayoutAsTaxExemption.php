<?php

namespace Omnipay\iPayout\Message\Transaction;
use Omnipay\iPayout\Message\AbstractRequest;

class eWallet_MarkPayoutAsTaxExemption extends AbstractRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'eWallet_MarkPayoutAsTaxExemption';
    }

    public function getData()
    {
        $data = $this->getBaseData();
        $accountsData = $this->getarrAccounts();

        $MerchantReferenceIDs = array();

        foreach($accountsData as $arrAccounts) {
            $MerchantReferenceIDs[] = $arrAccounts->getMerchantReferenceID();
        }

        $data['arrMerchantReferenceIDs'] = $MerchantReferenceIDs;
        return $data;
    }

    public function sendData($data)
    {
        return $this->sendDataByClass($data, '\Omnipay\iPayout\Message\Response\MarkPayoutAsTaxExemption');
    }
}

