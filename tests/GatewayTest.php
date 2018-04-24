<?php

namespace Omnipay\iPayout;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /** @var  Gateway */
    protected $gateway;

    /** @var  array */
    protected $options;

    /** @var  array */
    protected $loadaccounts;

    /** @var  array */
    protected $checkOptions;
    
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->ewallet = new \Omnipay\iPayout\eWallet();
        $this->ewallet->setUserName("jondoe");
        $this->ewallet->setName("John Doe");
        $this->ewallet->setAddress1("15505 Pennsylvania Ave.");
        $this->ewallet->setAddress2("Test");
        $this->ewallet->setCity("Washington DC");
        $this->ewallet->getZipCode("20003");
        $this->ewallet->setState("DC, NE");
        $this->ewallet->setCompany("DAB2LLC");
        $this->ewallet->setEmailAddress('test@test.com');
        $this->ewallet->setDateOfBirth('01/01/1980');
        $this->ewallet->validate();

        $this->paymentInfo = array(
            'UserName' => 'johndoe',
            'Amount'   => '1.00',
            'PartnerBatchID' => '2017-05-25',
            'Comments' => 'String for Partner Batch ID: 2017-05-25',
            'MerchantReferenceID' => '1234567890'
        );
        $this->loadaccounts = array();
        $this->loadaccounts[] = new \Omnipay\iPayout\Load($this->paymentInfo);

        $this->checkOptions = array (
            'UserName' => 'johndoe'
        );
    }

    public function testUsernamePassword() {
        $this->gateway->setMerchantID("username");
        $this->gateway->setAPIPassword("password");
        $this->gateway->setautoLoadPayment(true);

        $this->assertSame("username", $this->gateway->getMerchantID());
        $this->assertSame("password", $this->gateway->getAPIPassword());
        $this->assertTrue($this->gateway->getautoLoadPayment());
    }

    public function testCheckUserExistsSuccess()
    {
        $this->setMockHttpResponse('CheckUserExistsSuccess.txt');

        $response = $this->gateway->checkUserName($this->ewallet->getParameters())->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('User not found', $response->getResponseText());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }

    public function testCheckUserExistsFailure()
    {
        $this->setMockHttpResponse('CheckUserExistsFailure.txt');

        $response = $this->gateway->checkUserName($this->ewallet->getParameters())->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('OK', $response->getResponseText());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('OK', $response->getMessage());
    }

    public function testCreateUserSuccess()
    {
        $this->setMockHttpResponse('CreateUserSuccess.txt');

        $response = $this->gateway->createUser(array('ewallet' => $this->ewallet))->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }

    public function testCreateUserFailure()
    {
        $this->setMockHttpResponse('CreateUserFailure.txt');

        $response = $this->gateway->checkUserName($this->ewallet->getParameters())->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('A user with this UserName already exists', $response->getResponseText());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('A user with this UserName already exists', $response->getMessage());
    }

    public function testCheckAccountStatusSuccess()
    {
        $this->setMockHttpResponse('CheckAccountStatusSuccess.txt');

        $response = $this->gateway->checkAccountStatus($this->checkOptions)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }

    public function testIssueSuccess()
    {
        $this->setMockHttpResponse('IssueSuccess.txt');

        $response = $this->gateway->issuePayment(array(
            'arrAccounts' => $this->loadaccounts,
            'autoLoadPayment' => 1,
            'subdomain' => 'test'
        ))->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('OK', $response->getResponseText());
        $this->assertEquals('48247', $response->getTransactionId());
    }

    public function testMarkTaxExemption()
    {
        $this->setMockHttpResponse('MarkTaxExemptionSuccess.txt');

        $response = $this->gateway->markTaxExemption(array(
            'arrAccounts' => $this->loadaccounts
        ))->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('OK', $response->getResponseText());
    }
}
