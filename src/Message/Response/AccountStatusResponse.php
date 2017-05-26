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
        return !$this->isError() && $this->getResponse() && $this->getCode() === 0 && $this->data->response->AccStatus === 1;
    }
}
