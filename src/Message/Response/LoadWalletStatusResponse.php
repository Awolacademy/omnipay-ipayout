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
        return !$this->isError() && $this->getResponse() && $this->getCode() === 0 && $this->getTransactionId();
    }
}
