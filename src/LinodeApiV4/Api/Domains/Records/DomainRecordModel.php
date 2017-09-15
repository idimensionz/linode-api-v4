<?php
/*
 * iDimensionz/{linode-api-v4}
 * DomainRecordModel.php
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

namespace iDimensionz\LinodeApiV4\Api\Domains\Records;

/**
 * Class DomainRecordModel
 * @package iDimensionz\LinodeApiV4\Api\Domains
 * @see https://developers.linode.com/v4/reference/endpoints/domains/:id/records/:id
 */
class DomainRecordModel implements \JsonSerializable
{
    const TYPE_A = 'A';
    const TYPE_AAAA = 'AAAA';
    const TYPE_NS = 'NS';
    const TYPE_MX = 'MX';
    const TYPE_CNAME = 'CNAME';
    const TYPE_TXT = 'TXT';
    const TYPE_SRV = 'SRV';

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $target;
    /**
     * @var int
     */
    private $priority;
    /**
     * @var int
     */
    private $weight;
    /**
     * @var int
     */
    private $port;
    /**
     * @var string
     */
    private $service;
    /**
     * @var string
     */
    private $protocol;
    /**
     * @var int Represents the time-to-live in seconds.
     */
    private $ttl;

    public function __construct()
    {
        $this->populateEmpty();
    }

    /**
     * Sets all properties to null
     */
    public function populateEmpty()
    {
        $this->setId(null);
        $this->setType(null);
        $this->setName(null);
        $this->setTarget(null);
        $this->setPriority(null);
        $this->setWeight(null);
        $this->setPort(null);
        $this->setService(null);
        $this->setProtocol(null);
    }

    /**
     * @return array
     */
    public function getValidTypes()
    {
        return [
            self::TYPE_A,
            self::TYPE_AAAA,
            self::TYPE_NS,
            self::TYPE_MX,
            self::TYPE_CNAME,
            self::TYPE_TXT,
            self::TYPE_SRV
        ];
    }

    /**
     * @param string $type
     * @return bool
     */
    public function isValidType(string $type): bool
    {
        return in_array($type, $this->getValidTypes());
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @throws \InvalidArgumentException
     */
    public function setType(string $type)
    {
        if (!$this->isValidType($type)) {
            throw new \InvalidArgumentException(
                __METHOD__ . '/type must be one of ' . implode(', ', $this->getValidTypes()) . '.'
            );
        }
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string $target
     */
    public function setTarget(string $target)
    {
        $this->target = $target;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort(int $port)
    {
        if (0 > $port || 65535 < $port) {
            throw new \InvalidArgumentException(
                __METHOD__ . '/port parameter must be between 0 and 65535.'
            );
        }
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @param string $service
     */
    public function setService(string $service)
    {
        $this->service = $service;
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     */
    public function setProtocol(string $protocol)
    {
        $this->protocol = $protocol;
    }

    /**
     * @return int
     */
    public function getTtl(): int
    {
        return $this->ttl;
    }

    /**
     * @param int $ttl
     */
    public function setTtl(int $ttl)
    {
        if (0 > $ttl) {
            throw new \InvalidArgumentException(
                __METHOD__ . '/ttl parameter must be an integer 0 or greater.'
            );
        }
        $this->ttl = $ttl;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     * @throws \Exception
     */
    public function jsonSerialize()
    {
        $type = $this->getType();
        if (is_null($type)) {
            throw new \Exception(__METHOD__ . '/Type value must be set to JSON encode Domain Record Model.');
        }
        $data = [
            'type'  =>  $this->getType(),
        ];
        $name = $this->getName();
        if (!is_null($name)) {
            $data['name'] = $name;
        }
        $target = $this->getTarget();
        if (!is_null($target)) {
            $data['target'] = $target;
        }
        $priority = $this->getPriority();
        if (!is_null($priority)) {
            $data['priority'] = $priority;
        }
        $weight = $this->getWeight();
        if (!is_null($weight)) {
            $data['weight'] = $weight;
        }
        $port = $this->getPort();
        if (!is_null($port)) {
            $data['port'] = $port;
        }
        $service = $this->getService();
        if (!is_null($service)) {
            $data['service'] = $service;
        }
        $protocol = $this->getProtocol();
        if (!is_null($protocol)) {
            $data['protocol'] = $protocol;
        }
        $ttl = $this->getTtl();
        if (!is_null($ttl)) {
            $data['ttl'] = $ttl;
        }

        return $data;
    }
}
