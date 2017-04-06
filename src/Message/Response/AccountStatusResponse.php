<?php

namespace Omnipay\iPayout\Message\Response;

/**
 * CheckExistsResponse
 */
class AccountStatusResponse extends Response
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        if (isset($this->data->IsError) && $this->data->IsError == 1) {
            return false;
        }
        return isset($this->data->response) && $this->data->response->m_Code === 1;
    }
}
