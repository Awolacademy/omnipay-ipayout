<?php

namespace Omnipay\iPayout\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\iPayout\Message\Response\Response;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * Abstract Request
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * @var string
     */
    protected $liveEndpoint = 'https://i-payout.net/eWalletWS/ws_JsonAdapter.aspx';

    /**
     * @var string
     */
    protected $testEndpoint = 'https://testewallet.com/eWalletWS/ws_JsonAdapter.aspx';

    /**
     * @return string
     */
    abstract public function getType();

    public function getUsername()
    {
        return $this->getParameter('UserName');
    }

    public function setUsername($value)
    {
        return $this->setParameter('UserName', $value);
    }

    public function getMerchantID()
    {
        return $this->getParameter('MerchantID');
    }

    public function setMerchantID($value)
    {
        return $this->setParameter('MerchantID', $value);
    }

    public function setAPIPassword($value)
    {
        return $this->setParameter('APIPassword', $value);
    }

    public function getAPIPassword()
    {
        return $this->getParameter('APIPassword');
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
 
    /**
     * @codeCoverageIgnore
     */
    public function getSubdomain()
    {
        return $this->getParameter('Subdomain');
    }
    
    public function setSubdomain($value)
    {
        return $this->setParameter('Subdomain', $value);
    }
    
    public function getautoLoadPayment()
    {
        return $this->getParameter('autoLoadPayment');
    }
    
    public function setautoLoadPayment($value)
    {
        return $this->setParameter('autoLoadPayment', $value);
    }

    /**
     * @return Array
     */
    public function getBaseData()
    {
        $this->validate('MerchantID', 'APIPassword');
        $data = array();
        $data['fn'] = $this->getType();
        $data['MerchantGUID'] = $this->getMerchantID();
        $data['MerchantPassword'] = $this->getAPIPassword();
        return $data;
    }

    /**
     * @return string
     */

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    /**
     * Send a request to the gateway.
     *
     * The request should contain the following header settings:
     *
     * Content-type: application/json
     * Authorization: Bearer <OAuth Bearer Token>
     *
     * @param string $action
     * @param array  $data
     * @param string $method
     *
     * @return \Guzzle\Http\Message\Response
     * @throws InvalidResponseException
     */
    public function sendRequest($data = null)
    {
        // @codeCoverageIgnoreStart
        // don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );
        // @codeCoverageIgnoreEnd

        // Return the response we get back from AlliedWallet Payments

        // Create the HTTP request
        $httpRequest = $this->httpClient->createRequest(
            'POST',
            $this->getEndpoint(),
            array(
                'Accept'        => 'application/json',
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
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
        // @codeCoverageIgnoreEnd
    }
    
    public function sendDataByClass($data, $response = 'Reponse') {
        $httpResponse = $this->sendRequest($data);
        try {
            return $this->response = new $response($this, $httpResponse->json());
        // @codeCoverageIgnoreStart
        } catch(\Guzzle\Common\Exception\RuntimeException $e) {
            if (function_exists('log_message')) {
                try {
                    log_message('system', 'Error communicating with payment gateway: ' . (string) $httpResponse->getBody());
                } catch(Exception $e) {}
            }
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
        // @codeCoverageIgnoreEnd
    }
}
