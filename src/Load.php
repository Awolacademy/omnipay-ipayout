<?php
namespace Omnipay\iPayout;

use DateTime;
use DateTimeZone;
use Omnipay\Common\Exception\InvalidCreditCardException;
use Symfony\Component\HttpFoundation\ParameterBag;
use Omnipay\Common\Helper;
use Omnipay\iPayout;

/**
 * Load class
 */
class Load
{
    /**
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;

    /**
     * Create a new ACH object using the specified parameters
     *
     * @param array $parameters An array of parameters to set on the new object
     */
    public function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }

    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     *
     * @return $this
     */
    public function initialize($parameters = null)
    {
        $this->parameters = new ParameterBag;

        Helper::initialize($this, $parameters);

        return $this;
    }

    public function getParameters()
    {
        return $this->parameters->all();
    }

    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }

    public function setUserName($value)
    {
        return $this->setParameter('UserName', $value);
    }

    public function getUserName()
    {
        return $this->getParameter('UserName');
    }

    public function setAmount($value)
    {
        return $this->setParameter('Amount', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('Amount');
    }

    public function setMerchantReferenceID($value)
    {
        return $this->setParameter('MerchantReferenceID', $value);
    }

    public function getMerchantReferenceID()
    {
        return $this->getParameter('MerchantReferenceID');
    }

    public function setComments($value)
    {
        return $this->setParameter('Comments', $value);
    }

    public function getComments()
    {
        return $this->getParameter('Comments');
    }

    public function setPartnerBatchID($value)
    {
        return $this->setParameter('PartnerBatchID', $value);
    }

    public function getPartnerBatchID()
    {
        return $this->getParameter('PartnerBatchID');
    }

    /**
     * Validate this bank account. If the bank account is invalid, InvalidArgumentException is thrown.
     *
     */
    public function validate()
    {
        if (empty($this->getUserName())) {
            throw new \InvalidArgumentException('The account User Name is required.');
        }

        if (empty($this->getAmount())) {
            throw new \InvalidArgumentException('The payout Amount is required.');
        }

        if (empty($this->getMerchantReferenceID())) {
            throw new \InvalidArgumentException('The Merchant Reference ID is required.');
        }

        foreach (func_get_args() as $key) {
            $value = $this->parameters->get($key);
            if (!isset($value) || empty($value)) {
                throw new \InvalidArgumentException("The $key parameter is required");
            }
        }
    }
}