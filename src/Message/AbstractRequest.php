<?php

namespace Omnipay\iPayout\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\iPayout\Message\Response\Response;

/**
 * Abstract Request
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * @var string
     */
    protected $liveEndpoint = 'https://GAZ.testewallet.com:80/eWalletWS/ws_Adapter.aspx';
                                                                       // ^ KVP endpoint
                                                                       // JSON endpoint ws_JsonAdapter.aspx

    /**
     * @var string
     */
    protected $testEndpoint = 'https://GAZ.globalewallet.com:80/eWalletWS/ws_Adapter.aspx';
                                                                       // ^ KVP endpoint
                                                                     // JSON endpoint ws_JsonAdapter.aspx

    /**
     * @return string
     */
    abstract public function getType();

    /**
     * Get the gateway username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    /**
     * Set the gateway username
     *
     * @return AbstractRestRequest provides a fluent interface.
     */
    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    /**
    * Get the gateway password
    *
    * @return string
    */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
    * Set the gateway password
    *
    * @return string
    */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }
    
    public function getBankAccountPayee()
    {
        return $this->getParameter('bankAccountPayee');
    }
    
    public function setBankAccountPayee($value)
    {
        return $this->setParameter('bankAccountPayee', $value);
    }

    /**
     * @return Array
     */
    public function getBaseData()
    {
        $this->validate('MerchantGUID', 'MerchantPassword');
        
        $data = array();
        $data['fn'] = $this->getType();
        $data['MerchantGUID'] = $this->getUsername();
        $data['MerchantPassword'] = $this->getPassword();
        return $data;
    }

    /**
     * @param SimpleXMLElement $data
     * @return Response
     */

    public function sendData($data)
    {
        $headers      = array();
        $httpResponse = $this->httpClient->get($this->getEndpoint() .'?' . http_build_query($data), $headers)->send();
        return $this->createResponse($httpResponse->getBody());
    }

    
/* NEW JSON METOD     
    public function sendRequest($action, $data = null, $method = RequestInterface::POST)
    {
        // don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        // Return the response we get back from AlliedWallet Payments

        // Create the HTTP request
        $httpRequest = $this->httpClient->createRequest(
            $method,
            $this->getEndpoint() . $action,
            array(
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $this->getToken(),
                'Content-type'  => 'application/json'
            ),
            json_encode($data)
        );

        // Set the HTTP request options to TLS 1.2 and send the request,
        // returning the response.
        try {
            // Set TLS version to 1.2
            $httpRequest->getCurlOptions()->set(CURLOPT_SSLVERSION, 6);
            return $httpRequest->send();
        } catch (\Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }
*/    
    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    /**
     * @param string $data
     * @return Response
     */
    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }
}
