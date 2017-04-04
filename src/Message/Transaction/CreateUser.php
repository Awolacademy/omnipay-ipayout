<?php

namespace Omnipay\iPayout\Message;

class CreateUser extends AbstractRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'createuser';
    }
}