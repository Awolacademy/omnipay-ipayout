<?php

namespace Omnipay\iPay\Message\Transaction;

class RefundRequest extends CaptureRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'refund';
    }
}
