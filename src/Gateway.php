<?php
/**
 * iPay Gateway
 *              $gateway->setUsername('68a19ca1-7c45-471f-a896-2342b219c4b9');
                                        ^ Same on test & live
 *	            $gateway->setPassword('3xzpLSUPqg');
                                        ^ test password
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
    
    public function setAmount($value)
    {
        return $this->setParameter('Amount', $value);
    }

    public function getAmount($value)
    {
        return $this->getParameter('Amount');
    }

    public function setMerchantReferenceID($value)
    {
        return $this->setParameter('MerchantReferenceID', $value);
    }

    public function getMerchantReferenceID($value)
    {
        return $this->getParameter('MerchantReferenceID');
    }

    public function setAffiliateID($value)
    {
        return $this->setParameter('AffiliateID', $value);
    }

    public function getAffiliateID()
    {
        return $this->getParameter('AffiliateID');
    }

    public function checkUserName(array $parameters = array()) {
        return $this->createRequest('\Omnipay\iPayout\Message\Transaction\eWallet_CheckIfUserNameExists', $parameters);
    }

    public function createUser(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPayout\Message\Transaction\eWallet_CreateUser', $parameters);
    }
    
    public function checkAccountSatus(array $parameters = array()) {
        return $this->createRequest('\Omnipay\iPayout\Message\Transaction\eWallet_GetUserAccountStatus', $parameters);
    }

    public function issuePayment(array $parameters = array()) {
       log_message('system', sprintf('issuePayment %s', 'test'));
        return $this->createRequest('\Omnipay\iPayout\Message\Transaction\eWallet_Load', $parameters);
    }



}
