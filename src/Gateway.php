<?php
/**
 * iPayout Gateway
 */

namespace Omnipay\iPayout;

use Omnipay\Common\AbstractGateway;
use Guzzle\Http\Client as HttpClient;


class Gateway extends AbstractGateway
{
    /**
     * Get the global default HTTP client.
     *
     * @return HttpClient
     */
    protected function getDefaultHttpClient()
    {
        return new HttpClient(
            '',
            array(
                'curl.options' => array(
                    CURLOPT_CONNECTTIMEOUT => 60,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                ),
            )
        );
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'iPayout';
    }

   /**
     * Get the gateway default parameters
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'MerchantGUID' => '',
            'MerchantPassword' => ''
        );
    }

    /**
     * Get the gateway username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getParameter('UserName');
    }

    /**
     * Set the gateway username
     *
     * @return AbstractRestRequest provides a fluent interface.
     */
    public function setUsername($value)
    {
        return $this->setParameter('UserName', $value);
    }

    /**
     * Get the gateway username
     *
     * @return string
     */
    public function getMerchantID()
    {
        return $this->getParameter('MerchantGUID');
    }

    /**
     * Set the gateway username
     *
     * @param string username
     * @return interface.
     */
    public function setMerchantID($value)
    {
        return $this->setParameter('MerchantGUID', $value);
    }

    /**
     * Set the getway password
     *
     * @param string password
     * @return interface
     */
    public function setAPIPassword($value)
    {
        return $this->setParameter('MerchantPassword', $value);
    }

    /**
     * Get the gateway password
     *
     * @return string
     */
    public function getAPIPassword()
    {
        return $this->getParameter('MerchantPassword');
    }

    public function getEwallet()
    {
        return $this->getParameter('eWallet');
    }
    
    public function setEwallet($value)
    {
        return $this->setParameter('eWallet', $value);
    }
    
    public function getarrAccounts()
    {
        return $this->getParameter('arrAccounts');
    }
    
    public function setarrAccounts($value)
    {
        return $this->setParameter('arrAccounts', $value);
    }

    public function getautoLoadPayment()
    {
        return $this->getParameter('autoLoadPayment');
    }
    
    public function setautoLoadPayment($value)
    {
        return $this->setParameter('autoLoadPayment', $value);
    }
 
    public function getSubdomain()
    {
        return $this->getParameter('Subdomain');
    }
    
    public function setSubdomain($value)
    {
        return $this->setParameter('Subdomain', $value);
    }


    public function checkUserName(array $parameters = array()) {
        return $this->createRequest('\Omnipay\iPayout\Message\Transaction\eWallet_CheckIfUserNameExists', $parameters);
    }

    public function createUser(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPayout\Message\Transaction\eWallet_CreateUser', $parameters);
    }
    
    public function checkAccountStatus(array $parameters = array()) {
        return $this->createRequest('\Omnipay\iPayout\Message\Transaction\eWallet_GetUserAccountStatus', $parameters);
    }

    public function issuePayment(array $parameters = array()) {
       log_message('system', sprintf('issuePayment %s', 'test'));
        return $this->createRequest('\Omnipay\iPayout\Message\Transaction\eWallet_Load', $parameters);
    }



}
