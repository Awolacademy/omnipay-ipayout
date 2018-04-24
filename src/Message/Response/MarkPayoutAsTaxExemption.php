<?php

namespace Omnipay\iPayout\Message\Response;

/**
 * CheckExistsResponse
 */
class MarkPayoutAsTaxExemption extends Response
{
    /**
     * @return bool
     */

    public function isSuccessful()
    {
        return !$this->isError() && $this->getResponse() && $this->getCode() === 0;
    }
}
