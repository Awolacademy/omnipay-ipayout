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
    public function getautoLoadPayment()
    {
        return $this->getParameter('autoLoadPayment');
    }
    
    public function setautoLoadPayment($value)
    {
        return $this->setParameter('autoLoadPayment', $value);
    }
    public function getData()
    {
        $data = $this->getBaseData();
        $accountsData = $this->getarrAccounts();

        $loadAccounts = array();

        foreach($accountsData as $arrAccounts) {
            $paymentData =array();
            if (empty($arrAccounts->getUserName())) {
                throw new \InvalidArgumentException('The account User Name is required.');
            } else {
                $paymentData['UserName'] = $arrAccounts->getUserName();
            }

            if (empty($arrAccounts->getAmount())) {
                throw new \InvalidArgumentException('The payout Amount is required.');
            } else {
                $paymentData['Amount'] = $arrAccounts->getAmount();
            }

            if (empty($arrAccounts->getMerchantReferenceID())) {
                throw new \InvalidArgumentException('The Merchant Reference ID is required.');
            } else {
                $paymentData['MerchantReferenceID'] = $arrAccounts->getMerchantReferenceID();
            }

            if (empty($arrAccounts->getComments())) {
                throw new \InvalidArgumentException('The Comments field is required.');
            } else {
                $paymentData['Comments'] = $arrAccounts->getComments();
            }
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

