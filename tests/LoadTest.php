<?php

namespace Omnipay\TotalAppsGateway\Test;

use Omnipay\iPayout\Load;
use Omnipay\Tests\TestCase;

class LoadTest extends TestCase
{

    /**
     * @var Load
     */
    protected $load;

    public function setUp()
    {
        parent::setUp();

        $this->load = new Load();
        $this->load->setUserName("johndoe");
        $this->load->setAmount("1.00");
        $this->load->setMerchantReferenceID("1234567890");
        $this->load->setComments("Test Comment");
        $this->load->setPartnerBatchID("String for Partner Batch ID: 2000-01-01");
    }

    public function testValidateFixture() {
        $this->assertInstanceOf('Omnipay\iPayout\Load', $this->load);
        $this->assertSame(null, $this->load->validate());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The account User Name is required.
     */
    public function testValidateUserName()
    {
        $this->load->setUserName(null);
        $this->load->validate();
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The payout Amount is required.
     */
    public function testValidateAmount()
    {
        $this->load->setAmount(null);
        $this->load->validate();
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The Merchant Reference ID is required.
     */
    public function testValidateMerchantReference()
    {
        $this->load->setMerchantReferenceID(null);
        $this->load->validate();
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The value parameter is required
     */
    public function testValidateParamatersFailure()
    {
        $this->load->validate('value');
    }

    public function testConstructWithParams()
    {
        $load = new Load(array('UserName' => 'johndoe'));
        $this->assertSame('johndoe', $load->getUserName());
    }

    public function testInitializeWithParams()
    {
        $load = new Load;
        $load->initialize(array('UserName' => 'johndoe'));
        $this->assertSame('johndoe', $load->getUserName());
    }

    public function testGetParamters()
    {
        $load = new Load(array(
            'UserName' => 'johndoe',
            'Amount' => '1.00',
            'MerchantReferenceID' => '1234567890',
            'Comments' => "Test Comment",
            'PartnerBatchID' => "String for Partner Batch ID: 2000-01-01"
        ));

        $parameters = $load->getParameters();
        $this->assertSame('johndoe', $parameters['UserName']);
        $this->assertSame('1.00', $parameters['Amount']);
        $this->assertSame('Test Comment', $parameters['Comments']);
        $this->assertSame('String for Partner Batch ID: 2000-01-01', $parameters['PartnerBatchID']);
    }

    public function testFirstName()
    {
        $this->load->setUserName('johndoe');
        $this->assertEquals('johndoe', $this->load->getUserName());
    }

    public function testComments()
    {
        $this->load->setComments('Test Comment');
        $this->assertEquals('Test Comment', $this->load->getComments());
    }
    
    public function testPartnerBatchID()
    {
        $this->load->setPartnerBatchID('String for Partner Batch ID: 2000-01-01');
        $this->assertEquals('String for Partner Batch ID: 2000-01-01', $this->load->getPartnerBatchID());
    }
}