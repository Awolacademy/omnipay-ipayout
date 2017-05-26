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
        $accountsData = $this->getarrAccounts();

        $loadAccounts = array();

        foreach($accountsData as $arrAccounts) {
            $arrAccounts->validate('Comments');
            $paymentData = array();
            $paymentData['UserName'] = $arrAccounts->getUserName();
            $paymentData['Amount'] = $arrAccounts->getAmount();
            $paymentData['MerchantReferenceID'] = $arrAccounts->getMerchantReferenceID();
            $paymentData['Comments'] = $arrAccounts->getComments();
            $loadAccounts[] = $paymentData;
        }

        $data['PartnerBatchID'] = $arrAccounts->getPartnerBatchID();
        $data['arrAccounts'] = $loadAccounts;
        $data['AllowDuplicates'] = true;
        $data['AutoLoad'] = $this->getautoLoadPayment();
        $data['CurrencyCode'] = "USD";
        return $data;
    }

    public function sendData($data)
    {
        return $this->sendDataByClass($data, '\Omnipay\iPayout\Message\Response\LoadWalletStatusResponse');
    }
}

