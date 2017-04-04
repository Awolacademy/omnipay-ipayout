<?php

namespace Omnipay\iPay\Message;

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