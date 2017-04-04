<?php

namespace Omnipay\iPay\Message\Vault;

use Omnipay\iPay\Message\Response\DeleteResponse;

class VaultAchDeleteRequest extends VaultAchCreateRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'delete_customer';
    }
    
    /**
     * @return Array
     * @throws InvalidCreditCardException
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate('cardReference');
        $data = $this->getBaseData();
        unset($data['type']);
        $data['customer_vault'] = $this->getType();
        $data['customer_vault_id'] = $this->getCardReference();        
        return $data;
    }
    
    /**
     * @param string $data
     * @return Response
     */
    protected function createResponse($data)
    {
        return $this->response = new DeleteResponse($this, $data);
    }
}
