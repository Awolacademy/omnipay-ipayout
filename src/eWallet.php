<?php
namespace Omnipay\iPayout;

use DateTime;
use DateTimeZone;
use Omnipay\Common\Exception\InvalidCreditCardException;
use Symfony\Component\HttpFoundation\ParameterBag;
use Omnipay\Common\Helper;
use Omnipay\iPayout;

/**
 * eWallet class
 */
class eWallet
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

    public function setFirstName($value)
    {
        return $this->setParameter('FirstName', $value);
    }

    public function getFirstName()
    {
        return $this->getParameter('FirstName');
    }

    public function setLastName($value)
    {
        return $this->setParameter('LastName', $value);
    }

    public function getLastName()
    {
        return $this->getParameter('LastName');
    }

    public function getAddress1()
    {
        return $this->getParameter('Address1');
    }

    public function setAddress1($value)
    {
        return $this->setParameter('Address1', $value);
    }

    public function getAddress2()
    {
        return $this->getParameter('Address2');
    }

    public function setAddress2($value)
    {
        return $this->setParameter('Address2', $value);
    }
    
    public function getCity()
    {
        return $this->getParameter('City');
    }

    public function setCity($value)
    {
        return $this->setParameter('City', $value);
    }

    public function getZipCode()
    {
        return $this->getParameter('ZipCode');
    }

    public function setZipCode($value)
    {
        return $this->setParameter('ZipCode', $value);
    }

    public function getState()
    {
        return $this->getParameter('State');
    }

    public function setState($value)
    {
        return $this->setParameter('State', $value);
    }

    public function getCountry2xFormat()
    {
        return $this->getParameter('Country2xFormat');
    }

    public function setCountry2xFormat($value)
    {
        return $this->setParameter('Country2xFormat', $value);
    }

    public function getEmailAddress()
    {
        return $this->getParameter('EmailAddress');
    }

    public function setEmailAddress($value)
    {
        return $this->setParameter('EmailAddress', $value);
    }

    public function getDateOfBirth()
    {
        return $this->getParameter('DateOfBirth');
    }

    public function setDateOfBirth($value)
    {
        return $this->setParameter('DateOfBirth', $value);
    }

    public function getCompanyName()
    {
        return $this->getParameter('CompanyName');
    }

    public function setCompanyName($value)
    {
        return $this->setParameter('CompanyName', $value);
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
        
        if (empty($this->getFirstName())) {
            throw new \InvalidArgumentException('Your First Name is required.');
        }

        if (empty($this->getLastName())) {
            throw new \InvalidArgumentException('Your Last Name is required.');
        }
        
        if (empty($this->getEmailAddress())) {
            throw new \InvalidArgumentException('Your Email Address is required.');
        }

        if (empty($this->getDateOfBirth())) {
            throw new \InvalidArgumentException('Your Date Of Birth Address is required.');
        }

        foreach (func_get_args() as $key) {
            $value = $this->parameters->get($key);
            if (!isset($value) || empty($value)) {
                throw new \InvalidArgumentException("The $key parameter is required");
            }
        }
    }
}