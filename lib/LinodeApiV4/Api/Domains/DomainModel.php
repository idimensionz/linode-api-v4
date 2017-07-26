<?php
/*
 * iDimensionz/{linode-api-v4}
 * DomainModel.php
 *  
 * The MIT License (MIT)
 * 
 * Copyright (c) 2015 iDimensionz
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

namespace iDimensionz\LinodeApiV4\Api\Domains;

class DomainModel
{
    const STATUS_ACTIVE = 'active';
    const STATUS_DISABLED = 'disabled';
    const STATUS_EDIT_MODE = 'edit_mode';

    const TYPE_MASTER = 'master';
    const TYPE_SLAVE = 'slave';

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $domainName;
    /**
     * @var string
     */
    private $soaContactEmail;
    /**
     * @var string
     */
    private $description;
    /**
     * @var int (seconds)
     */
    private $refreshInterval;
    /**
     * @var int (seconds)
     */
    private $retryInterval;
    /**
     * @var int (seconds)
     */
    private $expireInterval;
    /**
     * @var int (seconds)
     */
    private $timeToLiveInterval;
    /**
     * @var DomainStatus
     */
    private $status;
    /**
     * @var array
     */
    private $masterIps;
    /**
     * @var array
     */
    private $axfrIps;
    /**
     * @var string
     */
    private $group;
    /**
     * @var DomainType
     */
    private $type;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     * @return string
     */
    public function getDomainName()
    {
        return $this->domainName;
    }

    /**
     * @param string $domainName
     */
    public function setDomainName($domainName)
    {
        $this->domainName = (string) $domainName;
    }

    /**
     * @return string
     */
    public function getSoaContactEmail()
    {
        return $this->soaContactEmail;
    }

    /**
     * @param string $soaContactEmail
     */
    public function setSoaContactEmail($soaContactEmail)
    {
        $this->soaContactEmail = (string) $soaContactEmail;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = (string) $description;
    }

    /**
     * @return int
     */
    public function getRefreshInterval()
    {
        return $this->refreshInterval;
    }

    /**
     * @param int $refreshInterval
     */
    public function setRefreshInterval($refreshInterval)
    {
        $this->refreshInterval = (int) $refreshInterval;
    }

    /**
     * @return int
     */
    public function getRetryInterval()
    {
        return $this->retryInterval;
    }

    /**
     * @param int $retryInterval
     */
    public function setRetryInterval($retryInterval)
    {
        $this->retryInterval = (int) $retryInterval;
    }

    /**
     * @return int
     */
    public function getExpireInterval()
    {
        return $this->expireInterval;
    }

    /**
     * @param int $expireInterval
     */
    public function setExpireInterval($expireInterval)
    {
        $this->expireInterval = (int) $expireInterval;
    }

    /**
     * @return int
     */
    public function getTimeToLiveInterval()
    {
        return $this->timeToLiveInterval;
    }

    /**
     * @param int $timeToLiveInterval
     */
    public function setTimeToLiveInterval($timeToLiveInterval)
    {
        $this->timeToLiveInterval = (int) $timeToLiveInterval;
    }

    /**
     * @return DomainStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param DomainStatus $status
     */
    public function setStatus($status)
    {
        $this->status = new DomainStatus($status);
    }

    /**
     * @return array
     */
    public function getMasterIps()
    {
        return $this->masterIps;
    }

    /**
     * @param array $masterIps
     */
    public function setMasterIps($masterIps)
    {
        if (!is_array($masterIps)) {
            throw new \InvalidArgumentException(__METHOD__ . '/masterIps parameter must be an array.');
        }
        $this->masterIps = $masterIps;
    }

    /**
     * @return array
     */
    public function getAxfrIps()
    {
        return $this->axfrIps;
    }

    /**
     * @param array $axfrIps
     */
    public function setAxfrIps($axfrIps)
    {
        if (!is_array($axfrIps)) {
            throw new \InvalidArgumentException(__METHOD__ . '/axfrIps parameter must be an array.');
        }
        $this->axfrIps = $axfrIps;
    }

    /**
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup($group)
    {
        $this->group = (string) $group;
    }

    /**
     * @return DomainType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param DomainType $type
     */
    public function setType($type)
    {
        $this->type = new DomainType($type);
    }
}
