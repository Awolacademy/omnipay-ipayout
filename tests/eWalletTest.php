<?php

namespace Omnipay\TotalAppsGateway\Test;

use Omnipay\iPayout\eWallet;
use Omnipay\Tests\TestCase;

class eWalletTest extends TestCase
{

    /**
     * @var eWallet
     */
    protected $ewallet;

    public function setUp()
    {
        parent::setUp();

        $this->ewallet = new eWallet();
        $this->ewallet->setUserName("jondoe");
        $this->ewallet->setName("John Doe");
        $this->ewallet->setAddress1("15505 Pennsylvania Ave.");
        $this->ewallet->setCity("Washington DC");
        $this->ewallet->getZipCode("20003");
        $this->ewallet->setState("DC, NE");
        $this->ewallet->setCompany("DAB2LLC");
        $this->ewallet->setEmailAddress('test@test.com');
        $this->ewallet->setDateOfBirth('01/01/1980');
        $this->ewallet->validate();
    }

    public function testValidateFixture() {
        $this->assertInstanceOf('Omnipay\iPayout\eWallet', $this->ewallet);
        $this->assertSame(null, $this->ewallet->validate());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Your Date Of Birth Address is required.
     */
    public function testValidateDateOfBirth()
    {
        $this->ewallet->setDateOfBirth(null);
        $this->ewallet->validate();
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Your Email Address is required.
     */
    public function testValidateEmailAddress()
    {
        $this->ewallet->setEmailAddress(null);
        $this->ewallet->validate();
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Your First Name is required.
     */
    public function testValidateFirstName()
    {
        $this->ewallet->setFirstName(null);
        $this->ewallet->validate();
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Your Last Name is required.
     */
    public function testValidateLastName()
    {
        $this->ewallet->setLastName(null);
        $this->ewallet->validate();
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The account User Name is required.
     */
    public function testValidateUserName()
    {
        $this->ewallet->setUserName(null);
        $this->ewallet->validate();
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The value parameter is required
     */
    public function testValidateParamatersFailure()
    {
        $this->ewallet->validate('value');
    }

    public function testConstructWithParams()
    {
        $ach = new eWallet(array('name' => 'Test Customer'));
        $this->assertSame('Test Customer', $ach->getName());
    }

    public function testInitializeWithParams()
    {
        $ach = new eWallet;
        $ach->initialize(array('name' => 'Test Customer'));
        $this->assertSame('Test Customer', $ach->getName());
    }

    public function testGetParamters()
    {
        $ach = new eWallet(array(
            'name' => 'John Doe',
            'UserName' => 'jondoe',
            'DateOfBirth' => '01/01/1980',
            'EmailAddress' => 'test@test.com'
        ));

        $parameters = $ach->getParameters();
        $this->assertSame('John', $parameters['FirstName']);
        $this->assertSame('Doe', $parameters['LastName']);
        $this->assertSame('01/01/1980', $parameters['DateOfBirth']);
        $this->assertSame('test@test.com', $parameters['EmailAddress']);
    }

    public function testFirstName()
    {
        $this->ewallet->setFirstName('Bob');
        $this->assertEquals('Bob', $this->ewallet->getFirstName());
    }

    public function testLastName()
    {
        $this->ewallet->setLastName('Smith');
        $this->assertEquals('Smith', $this->ewallet->getLastName());
    }

    public function testGetName()
    {
        $this->ewallet->setFirstName('Bob');
        $this->ewallet->setLastName('Smith');
        $this->assertEquals('Bob Smith', $this->ewallet->getName());
    }

    public function testSetName()
    {
        $this->ewallet->setName('Bob Smith');
        $this->assertEquals('Bob', $this->ewallet->getFirstName());
        $this->assertEquals('Smith', $this->ewallet->getLastName());
    }

    public function testSetNameWithOneName()
    {
        $this->ewallet->setName('Bob');
        $this->assertEquals('Bob', $this->ewallet->getFirstName());
        $this->assertEquals('', $this->ewallet->getLastName());
    }

    public function testSetNameWithMultipleNames()
    {
        $this->ewallet->setName('Bob John Smith');
        $this->assertEquals('Bob', $this->ewallet->getFirstName());
        $this->assertEquals('John Smith', $this->ewallet->getLastName());
    }

    /*  Company */
    public function testCompany()
    {
        $this->ewallet->setCompany('SuperSoft');
        $this->assertEquals('SuperSoft', $this->ewallet->getCompany());

        $this->ewallet->setCompanyName('SuperDaft');
        $this->assertEquals('SuperDaft', $this->ewallet->getCompanyName());
    }

    public function testAddress1()
    {
        $this->ewallet->setAddress1('31 Spooner St');
        $this->assertEquals('31 Spooner St', $this->ewallet->getAddress1());
    }

    public function testAddress2()
    {
        $this->ewallet->setAddress2('Suburb');
        $this->assertEquals('Suburb', $this->ewallet->getAddress2());
    }

    public function testCity()
    {
        $this->ewallet->setCity('Quahog');
        $this->assertEquals('Quahog', $this->ewallet->getCity());
        $this->assertEquals('Quahog', $this->ewallet->getCity());
    }

    public function testPostcode()
    {
        $this->ewallet->setPostcode('12345');
        $this->assertEquals('12345', $this->ewallet->getPostcode());
        
        $this->ewallet->setZipCode('123456');
        $this->assertEquals('123456', $this->ewallet->getZipCode());
    }

    public function testState()
    {
        $this->ewallet->setState('RI');
        $this->assertEquals('RI', $this->ewallet->getState());
    }

    public function testCountry()
    {
        $this->ewallet->setCountry('US');
        $this->assertEquals('US', $this->ewallet->getCountry());

        $this->ewallet->setCountry2xFormat('CA');
        $this->assertEquals('CA', $this->ewallet->getCountry2xFormat());
    }
}