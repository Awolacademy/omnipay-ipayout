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
    protected $liveEndpoint = 'https://GAZ.testewallet.com/eWalletWS/ws_JsonAdapter.aspx';

    /**
     * @var string
     */
    protected $testEndpoint = 'https://GAZ.globalewallet.com/eWalletWS/ws_JsonAdapter.aspx';

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

    public function getMerchantGUID()
    {
        return $this->getParameter('MerchantGUID');
    }

    public function setMerchantGUID($value)
    {
        return $this->setParameter('MerchantGUID', $value);
    }

    public function setMerchantPassword($value)
    {
        return $this->setParameter('MerchantPassword', $value);
    }

    public function getMerchantPassword()
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


    /**
     * @return Array
     */
    public function getBaseData()
    {
        $this->validate('MerchantGUID', 'MerchantPassword');
        $data = array();
        $data['fn'] = $this->getType();
        $data['MerchantGUID'] = $this->getMerchantGUID();
        $data['MerchantPassword'] = $this->getMerchantPassword();
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
     * @param string $data
     * @return Response
     */
    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
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
        } catch (\Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }
    
    public function sendDataByClass($data, $response = 'Reponse') {
        $httpResponse = $this->sendRequest($data);
        try {
            return $this->response = new $response($this, $httpResponse->json());
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
    }

    public function sendData($data)
    {
        return $this->sendDataByClass($data, 'Reponse');
    }
}
