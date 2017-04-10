<?php

namespace Omnipay\iPayout\Message\Response;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Response
 */
class Response extends AbstractResponse
{    
    /**
     * Constructor
     *
     * @param RequestInterface $request the initiating request.
     * @param mixed $data
     */
    public function __construct(RequestInterface $request, $data)
    {
        $data = json_decode(json_encode($data), FALSE);
        parent::__construct($request, (object)$data);
    }
    
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        if (isset($this->data->IsError) && $this->data->IsError == 1) {
            return false;
        }
        return isset($this->data->response) && $this->data->response->m_Code === 0;
    }
    
    /**
     * @return bool
     */
    public function getResponse()
    {
        return $this->data->response;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return false;
    }

    /**
     * Get the transaction ID as generated by the merchant website.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return (isset($this->data->response) && isset($this->data->response->TransactionRefID) ) ? $this->data->response->TransactionRefID : null;
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        $errors = array();
        if (!$this->isSuccessful()) {
            $errors[] = $this->getResponseText();
        }
        
        if (empty($errors)) {
            return null;
        }

        return implode($errors, '; ');
    }
        
    /**
     * Response text
     *
     * @return null|string A response code from the payment gateway
     */
    public function getResponseText()
    {
        return ( isset($this->data->response) && isset($this->data->response->m_Text) ) ? $this->data->response->m_Text : null;
    }

    /**
     * Response code
     *
     * @return null|string A response code from the payment gateway
     */
    public function getCode()
    {
        // m_Code
        return ( isset($this->data->response) && isset($this->data->response->m_Code) ) ? (int)$this->data->response->m_Code : null;
    }
}
