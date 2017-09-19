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
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string|null
     */
    private $domainName;
    /**
     * @var string|null
     */
    private $soaContactEmail;
    /**
     * @var string|null
     */
    private $description;
    /**
     * @var int|null (seconds)
     */
    private $refreshInterval;
    /**
     * @var int|null (seconds)
     */
    private $retryInterval;
    /**
     * @var int|null (seconds)
     */
    private $expireInterval;
    /**
     * @var int|null (seconds)
     */
    private $timeToLiveInterval;
    /**
     * @var DomainStatus|null
     */
    private $status;
    /**
     * @var array|null
     */
    private $masterIps;
    /**
     * @var array|null
     */
    private $axfrIps;
    /**
     * @var string|null
     */
    private $group;
    /**
     * @var DomainType|null
     */
    private $type;

    public function __construct()
    {
        $this->populateEmpty();
    }

    public function populateEmpty()
    {
        $this->setId(null);
        $this->setDomainName(null);
        $this->setSoaContactEmail(null);
        $this->setDescription(null);
        $this->setRefreshInterval(null);
        $this->setRetryInterval(null);
        $this->setExpireInterval(null);
        $this->setTimeToLiveInterval(null);
        $this->setStatus(null);
        $this->setMasterIps(null);
        $this->setAxfrIps(null);
        $this->setGroup(null);
        $this->setType(null);
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId($id)
    {
        if (!is_null($id)) {
            $id = (int) $id;
        }
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getDomainName()
    {
        return $this->domainName;
    }

    /**
     * @param string|null $domainName
     */
    public function setDomainName($domainName)
    {
        if (!is_null($domainName)) {
            $domainName = (string) $domainName;
        }
        $this->domainName = $domainName;
    }

    /**
     * @return string|null
     */
    public function getSoaContactEmail()
    {
        return $this->soaContactEmail;
    }

    /**
     * @param string|null $soaContactEmail
     */
    public function setSoaContactEmail($soaContactEmail)
    {
        if (!is_null($soaContactEmail)) {
            $soaContactEmail = (string) $soaContactEmail;
        }
        $this->soaContactEmail = $soaContactEmail;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription($description)
    {
        if (!is_null($description)) {
            $description = (string) $description;
        }
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getRefreshInterval()
    {
        return $this->refreshInterval;
    }

    /**
     * @param int|null $refreshInterval
     */
    public function setRefreshInterval($refreshInterval)
    {
        if (!is_null($refreshInterval)) {
            $refreshInterval = (int) $refreshInterval;
        }
        $this->refreshInterval = $refreshInterval;
    }

    /**
     * @return int|null
     */
    public function getRetryInterval()
    {
        return $this->retryInterval;
    }

    /**
     * @param int|null $retryInterval
     */
    public function setRetryInterval($retryInterval)
    {
        if (!is_null($retryInterval)) {
            $retryInterval = (int) $retryInterval;
        }
        $this->retryInterval = $retryInterval;
    }

    /**
     * @return int|null
     */
    public function getExpireInterval()
    {
        return $this->expireInterval;
    }

    /**
     * @param int|null $expireInterval
     */
    public function setExpireInterval($expireInterval)
    {
        if (!is_null($expireInterval)) {
            $expireInterval = (int) $expireInterval;
        }
        $this->expireInterval = $expireInterval;
    }

    /**
     * @return int|null
     */
    public function getTimeToLiveInterval()
    {
        return $this->timeToLiveInterval;
    }

    /**
     * @param int|null $timeToLiveInterval
     */
    public function setTimeToLiveInterval($timeToLiveInterval)
    {
        if (!is_null($timeToLiveInterval)) {
            $timeToLiveInterval = (int) $timeToLiveInterval;
        }
        $this->timeToLiveInterval = $timeToLiveInterval;
    }

    /**
     * @return DomainStatus|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus($status)
    {
        if (!is_null($status)) {
            $status = (string) $status;
            $domainStatus = new DomainStatus($status);
        } else {
            $domainStatus = null;
        }
        $this->setDomainStatus($domainStatus);
    }

    /**
     * @param DomainStatus|null $domainStatus
     */
    public function setDomainStatus($domainStatus)
    {
        if (!is_null($domainStatus)) {
            if (!$domainStatus instanceof DomainStatus) {
                throw new \InvalidArgumentException(
                    __METHOD__ . '/domainStatus parameter must be null or an instance of DomainStatus.'
                );
            }
        }
        $this->status = $domainStatus;
    }

    /**
     * @return array|null
     */
    public function getMasterIps()
    {
        return $this->masterIps;
    }

    /**
     * @param array|null $masterIps
     */
    public function setMasterIps($masterIps)
    {
        if (!is_null($masterIps)) {
            if (!is_array($masterIps)) {
                throw new \InvalidArgumentException(__METHOD__ . '/masterIps parameter must be an array.');
            }
        }
        $this->masterIps = $masterIps;
    }

    /**
     * @return array|null
     */
    public function getAxfrIps()
    {
        return $this->axfrIps;
    }

    /**
     * @param array|null $axfrIps
     */
    public function setAxfrIps($axfrIps)
    {
        if (!is_null($axfrIps)) {
            if (!is_array($axfrIps)) {
                throw new \InvalidArgumentException(__METHOD__ . '/axfrIps parameter must be an array.');
            }
        }
        $this->axfrIps = $axfrIps;
    }

    /**
     * @return string|null
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param string|null $group
     */
    public function setGroup($group)
    {
        if (!is_null($group)) {
            $group = (string) $group;
        }
        $this->group = $group;
    }

    /**
     * @return DomainType|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType($type)
    {
        if (!is_null($type)) {
            $type = (string) $type;
            $domainType = new DomainType($type);
        } else {
            $domainType = null;
        }
        $this->setDomainType($domainType);
    }

    /**
     * @param DomainType|null $type
     */
    public function setDomainType($type)
    {
        if (!is_null($type)) {
            if (!$type instanceof DomainType) {
                throw new \InvalidArgumentException(
                    __METHOD__ . '/type parameter must be null or an instance of DomainType.'
                );
            }
        }
        $this->type = $type;
    }

    /**
     * Transform the model data to an array.
     * This is useful when calling POST, PUT or PATCH endpoints.
     * Used primarily to send data TO an API endpoint, so null values are not included.
     * @return array
     */
    public function toArray(): array
    {
        $data = [];
        $domain = $this->getDomainName();
        if (!is_null($domain)) {
            $data['domain'] = $domain;
        }
        $type = $this->getType();
        if (!is_null($type)) {
            $data['type'] = (string) $type;
        }
        $soaContactEmail = $this->getSoaContactEmail();
        if (!is_null($soaContactEmail)) {
            $data['soa_email'] = $soaContactEmail;
        }
        $description = $this->getDescription();
        if (!is_null($description)) {
            $data['description'] = $description;
        }
        $refreshInterval = $this->getRefreshInterval();
        if (!is_null($refreshInterval)) {
            $data['refresh_sec'] = $refreshInterval;
        }
        $retryInterval = $this->getRetryInterval();
        if (!is_null($retryInterval)) {
            $data['retry_sec'] = $retryInterval;
        }
        $expireInterval = $this->getExpireInterval();
        if (!is_null($expireInterval)) {
            $data['expire_sec'] = $expireInterval;
        }
        $ttlInterval = $this->getTimeToLiveInterval();
        if (!is_null($ttlInterval)) {
            $data['ttl_sec'] = $ttlInterval;
        }
        $status = $this->getStatus();
        if (!is_null($status)) {
            $data['status'] = $status;
        }
        $masterIps = $this->getMasterIps();
        if (!is_null($masterIps)) {
            $data['master_ips'] = $masterIps;
        }
        $axfrIps = $this->getAxfrIps();
        if (!is_null($axfrIps)) {
            $data['axfr_ips'] = $axfrIps;
        }
        $group = $this->getGroup();
        if (!is_null($group)) {
            $data['group'] = $group;
        }

        return $data;
    }
}
