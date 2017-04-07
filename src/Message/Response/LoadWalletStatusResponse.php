<?php

namespace Omnipay\iPayout\Message\Response;

/**
 * CheckExistsResponse
 */
class LoadWalletStatusResponse extends Response
{
    /**
     * @return bool
     */

    public function isSuccessful()
    {
        if (isset($this->data->IsError) && $this->data->IsError == 1) {
            return false;
        }
        
        return isset($this->data->response) && $this->data->response->m_Code === 0 && $this->data->response->TransactionRefID;
    }
    
    
    public function getTransactionID() {
        if (!isset($this->data->response) && !$this->data->response->TransactionRefID) {
            return false;
        }

        return $this->data->response->TransactionRefID;
    }    

}
