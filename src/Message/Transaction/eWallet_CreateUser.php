<?php

namespace Omnipay\iPayout\Message\Transaction;

use Omnipay\iPayout\eWallet;
use Omnipay\iPayout\Message\AbstractRequest;

class eWallet_CreateUser extends AbstractRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'eWallet_CreateUser';
    }

    public function getData()
    {
        $data = $this->getBaseData();
        $ewallet = $this->getEwallet();

        $data['FirstName'] = $ewallet->getFirstName();
        $data['LastName'] = $ewallet->getLastName();
        $data['UserName'] = $ewallet->getUserName();
        $data['Address1'] = $ewallet->getAddress1();
        $data['City'] = $ewallet->getCity();
        $data['ZipCode'] = $ewallet->getZipCode();
        $data['State'] = $ewallet->getState();
        $data['Country2xFormat'] = $ewallet->getCountry2xFormat();
        $data['EmailAddress'] = $ewallet->getEmailAddress();
        $data['DateOfBirth'] = $ewallet->getDateOfBirth();
        if(!empty($ewallet->getAddress2())) {
            $data['Address2'] = $ewallet->getAddress2();
        }
        if(!empty($ewallet->getCompanyName())) {
            $data['CompanyName'] = $ewallet->getCompanyName();
        }        
        return $data;
    }

    public function sendData($data)
    {
        return $this->sendDataByClass($data, '\Omnipay\iPayout\Message\Response\Response');
    }
}

