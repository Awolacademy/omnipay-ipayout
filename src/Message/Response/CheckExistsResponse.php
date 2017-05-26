<?php

namespace Omnipay\iPayout\Message\Response;

/**
 * CheckExistsResponse
 */
class CheckExistsResponse extends Response
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return !$this->isError() && $this->getResponse() && $this->getCode() === -2;
    }
}
