<?php
/*
 * iDimensionz/{linode-api-v4}
 * DomainModelUnitTest.php
 *  
 * The MIT License (MIT)
 * 
 * Copyright (c) 2017 Dimensionz
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
*/

namespace iDimensionz\Tests\Api\Domains;

use iDimensionz\LinodeApiV4\Api\Domains\DomainModel;
use iDimensionz\LinodeApiV4\Api\Domains\DomainStatus;
use iDimensionz\LinodeApiV4\Api\Domains\DomainType;
use PHPUnit\Framework\TestCase;

class DomainModelUnitTest extends TestCase
{
    const VALID_ID = 123;
    const VALID_DOMAIN_NAME = 'mydomain.example.com';
    const VALID_CONTACT_EMAIL = 'test@example.com';
    const VALID_DESCRIPTION = 'Some useful info goes here.';
    const VALID_REFRESH_INTERVAL = 7200;
    const VALID_RETRY_INTERVAL = 600;
    const VALID_EXPIRE_INTERVAL = 604800;
    const VALID_TTL_INTERVAL = 1800;
    const VALID_MASTER_IPS = ['127.0.0.1'];
    const VALID_AXFR_IPS = ['104.237.137.10'];
    const VALID_GROUP = 'test';
    const VALID_TYPE = DomainType::MASTER;
    const VALID_STATUS = DomainStatus::DISABLED;

    /**
     * @var DomainModel
     */
    private $domainModel;

    public function setUp()
    {
        parent::setUp();
        $this->domainModel = new DomainModel();
    }

    public function tearDown()
    {
        unset($this->domainModel);
        parent::tearDown();
    }

    public function testPopulateEmptySetsAllPropertiesToNull()
    {
        // First set all properties to some value;
        $this->hasValidValues();
        // Now call the function.
        $this->domainModel->populateEmpty();
        $this->assertAllNullProperties();
    }

    public function testConstructSetsAllPropertiesToNull()
    {
        $this->assertAllNullProperties();
    }

    public function testIdGetterAndSetter()
    {
        $this->hasValidValues();
        $actualId = $this->domainModel->getId();
        $this->assertTrue(is_int($actualId));
        $this->assertEquals(self::VALID_ID, $actualId);
    }

    public function testDomainNameGetterAndSetter()
    {
        $this->hasValidValues();
        $actualDomain = $this->domainModel->getDomainName();
        $this->assertTrue(is_string($actualDomain));
        $this->assertEquals(self::VALID_DOMAIN_NAME, $actualDomain);
    }

    public function testContactEmailGetterAndSetter()
    {
        $this->hasValidValues();
        $actualEmail = $this->domainModel->getSoaContactEmail();
        $this->assertTrue(is_string($actualEmail));
        $this->assertEquals(self::VALID_CONTACT_EMAIL, $actualEmail);
    }

    public function testDescriptionGetterAndSetter()
    {
        $this->hasValidValues();
        $actualDescription = $this->domainModel->getDescription();
        $this->assertTrue(is_string($actualDescription));
        $this->assertEquals(self::VALID_DESCRIPTION, $actualDescription);
    }

    public function testRefreshIntervalGetterAndSetter()
    {
        $this->hasValidValues();
        $actualRefreshInterval = $this->domainModel->getRefreshInterval();
        $this->assertTrue(is_int($actualRefreshInterval));
        $this->assertEquals(self::VALID_REFRESH_INTERVAL, $actualRefreshInterval);
    }

    public function testRetryIntervalGetterAndSetter()
    {
        $this->hasValidValues();
        $actualRetryInterval = $this->domainModel->getRetryInterval();
        $this->assertTrue(is_int($actualRetryInterval));
        $this->assertEquals(self::VALID_RETRY_INTERVAL, $actualRetryInterval);
    }

    public function testExpireIntervalGetterAndSetter()
    {
        $this->hasValidValues();
        $actualExpireInterval = $this->domainModel->getExpireInterval();
        $this->assertTrue(is_int($actualExpireInterval));
        $this->assertEquals(self::VALID_EXPIRE_INTERVAL, $actualExpireInterval);
    }

    public function testTTLIntervalGetterAndSetter()
    {
        $this->hasValidValues();
        $actualTtlInterval = $this->domainModel->getTimeToLiveInterval();
        $this->assertTrue(is_int($actualTtlInterval));
        $this->assertEquals(self::VALID_TTL_INTERVAL, $actualTtlInterval);
    }

    public function testStatusGetterAndSetter()
    {
        $this->hasValidValues();
        $actualStatus = $this->domainModel->getStatus();
        $this->assertInstanceOf('\iDimensionz\LinodeApiV4\Api\Domains\DomainStatus', $actualStatus);
        $this->assertEquals(self::VALID_STATUS, $actualStatus->getValue());
    }

    public function testMasterIpsGetterAndSetter()
    {
        $this->hasValidValues();
        $actualMasterIps = $this->domainModel->getMasterIps();
        $this->assertTrue(is_array($actualMasterIps));
        $this->assertEquals(self::VALID_MASTER_IPS, $actualMasterIps);
    }

    public function testAxfrIpsGetterAndSetter()
    {
        $this->hasValidValues();
        $actualAxfrIps = $this->domainModel->getAxfrIps();
        $this->assertTrue(is_array($actualAxfrIps));
        $this->assertEquals(self::VALID_AXFR_IPS, $actualAxfrIps);
    }

    public function testGroupGetterAndSetter()
    {
        $this->hasValidValues();
        $actualGroup = $this->domainModel->getGroup();
        $this->assertTrue(is_string($actualGroup));
        $this->assertEquals(self::VALID_GROUP, $actualGroup);
    }

    public function testTypeGetterAndSetter()
    {
        $this->hasValidValues();
        $actualType = $this->domainModel->getType();
        $this->assertInstanceOf('\iDimensionz\LinodeApiV4\Api\Domains\DomainType', $actualType);
        $this->assertEquals(self::VALID_TYPE, $actualType->getValue());
    }

    /**
     * Setup some sane values in the model.
     */
    private function hasValidValues()
    {
        $this->domainModel->setId(self::VALID_ID);
        $this->domainModel->setDomainName(self::VALID_DOMAIN_NAME);
        $this->domainModel->setSoaContactEmail(self::VALID_CONTACT_EMAIL);
        $this->domainModel->setDescription(self::VALID_DESCRIPTION);
        $this->domainModel->setRefreshInterval(self::VALID_REFRESH_INTERVAL);
        $this->domainModel->setRetryInterval(self::VALID_RETRY_INTERVAL);
        $this->domainModel->setExpireInterval(self::VALID_EXPIRE_INTERVAL);
        $this->domainModel->setTimeToLiveInterval(self::VALID_TTL_INTERVAL);
        $this->domainModel->setStatus(self::VALID_STATUS);
        $this->domainModel->setMasterIps(self::VALID_MASTER_IPS);
        $this->domainModel->setAxfrIps(self::VALID_AXFR_IPS);
        $this->domainModel->setGroup(self::VALID_GROUP);
        $this->domainModel->setType(self::VALID_TYPE);
    }

    private function assertAllNullProperties()
    {
        $this->assertNull($this->domainModel->getId());
        $this->assertNull($this->domainModel->getDomainName());
        $this->assertNull($this->domainModel->getSoaContactEmail());
        $this->assertNull($this->domainModel->getDescription());
        $this->assertNull($this->domainModel->getRefreshInterval());
        $this->assertNull($this->domainModel->getRetryInterval());
        $this->assertNull($this->domainModel->getExpireInterval());
        $this->assertNull($this->domainModel->getTimeToLiveInterval());
        $this->assertNull($this->domainModel->getStatus());
        $this->assertNull($this->domainModel->getMasterIps());
        $this->assertNull($this->domainModel->getAxfrIps());
        $this->assertNull($this->domainModel->getGroup());
        $this->assertNull($this->domainModel->getType());
    }
}
