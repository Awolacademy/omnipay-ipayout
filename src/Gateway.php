<?php
/**
 * iPay Gateway
 *              $gateway->setUsername('68a19ca1-7c45-471f-a896-2342b219c4b9');
                                        ^ Same on test & live
 *	            $gateway->setPassword('3xzpLSUPqg');
                                        ^ test password
 */

namespace Omnipay\iPay;

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
        return 'iPay';
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

    















    /**
    
    
     * @param array $parameters
     * @return Message\Transaction\AuthorizeRequest
     * Authorize = auth
     */
    /*public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPay\Message\Transaction\AuthorizeRequest', $parameters);
    }*/

    /**
     * @param array $parameters
     * @return Message\Transaction\PurchaseRequest
     * Purchase = sale
     */
    /*public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPay\Message\Transaction\PurchaseRequest', $parameters);
    }*/
    
    /**
     * @param array $parameters
     * @return Message\Transaction\CreditRequest
     * Credit = credit
     */
/*
    public function credit(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPay\Message\Transaction\CreditRequest', $parameters);
    }
*/
    /**
     * @param array $parameters
     * @return Message\Transaction\RefundRequest
     * Refund = refund
     */
    /*public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPay\Message\Transaction\RefundRequest', $parameters);
    }*/
    
    /**
     * @param array $parameters
     * @return Message\Vault\VaultCreateRequest
     * Vault Create = auth
     */
    /*public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPay\Message\Vault\VaultCreateRequest', $parameters);
    }*/
    
    /**
     * @param array $parameters
     * @return Message\Vault\VaultDeleteRequest
     * Vault Delete = delete
     */
    /*public function deleteCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPay\Message\Vault\VaultDeleteRequest', $parameters);
    }*/
    
    /**
     * @param array $parameters
     * @return Message\Vault\VaultUpdateRequest
     * Vault Update = update
     */
    /*public function updateCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPay\Message\Vault\VaultUpdateRequest', $parameters);
    }*/
    
    /**
     * @param array $parameters
     * @return Message\Vault\VaultCustomerListRecordsRequest
     * Vault List = list_customer
     */
    /*public function listCards(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPay\Message\Vault\VaultCustomerListRecordsRequest', $parameters);
    }*/
    
    /**
     * @param array $parameters
     * @return Message\Transaction\CaptureRequest
     * Capture = capture
     */
    /*public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPay\Message\Transaction\CaptureRequest', $parameters);
    }*/
    
    /**
     * @param array $parameters
     * @return Message\Transaction\VoidRequest
     * Void = void
     */
    /*public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPay\Message\Transaction\VoidRequest', $parameters);
    }*/
    
    /**
     * @param array $parameters
     * @return Message\Subscription\SubscriptionAddRequest
     * Subscription Add = sub_add
     */
    /*public function subscription_add(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPay\Message\Subscription\SubscriptionAddRequest', $parameters);
    }*/
    
    /**
     * @param array $parameters
     * @return Message\Subscription\SubscriptionDeleteRequest
     * Subscription Add = delete_sub
     */
    /*public function subscription_delete(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\iPay\Message\Subscription\SubscriptionDeleteRequest', $parameters);
    }*/

}
