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
     * @var int|null
     */
    private $id;
    /**
     * @var string|null
     */
    private $type;
    /**
     * @var string|null
     */
    private $name;
    /**
     * @var string|null
     */
    private $target;
    /**
     * @var int|null
     */
    private $priority;
    /**
     * @var int|null
     */
    private $weight;
    /**
     * @var int|null
     */
    private $port;
    /**
     * @var string|null
     */
    private $service;
    /**
     * @var string|null
     */
    private $protocol;
    /**
     * @var int|null Represents the time-to-live in seconds.
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
     * @return int|null
     */
    public function getId(): int
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @throws \InvalidArgumentException
     */
    public function setType($type)
    {
        if (!is_null($type)) {
            if (!$this->isValidType($type)) {
                throw new \InvalidArgumentException(
                    __METHOD__ . '/type must be one of ' . implode(', ', $this->getValidTypes()) . '.'
                );
            }
        }
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName($name)
    {
        if (!is_null($name)) {
            $name = (string) $name;
        }
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string|null $target
     */
    public function setTarget($target)
    {
        if (!is_null($target)) {
            $target = (string) $target;
        }
        $this->target = $target;
    }

    /**
     * @return int|null
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int|null $priority
     */
    public function setPriority($priority)
    {
        if (!is_null($priority)) {
            $priority = (int) $priority;
        }
        $this->priority = $priority;
    }

    /**
     * @return int|null
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int|null $weight
     */
    public function setWeight($weight)
    {
        if (!is_null($weight)) {
            $weight = (int) $weight;
        }
        $this->weight = $weight;
    }

    /**
     * @return int|null
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int|null $port
     */
    public function setPort($port)
    {
        if (!is_null($port)) {
            if (0 > $port || 65535 < $port) {
                throw new \InvalidArgumentException(
                    __METHOD__ . '/port parameter must be between 0 and 65535.'
                );
            }
            $port = (int)$port;
        }
        $this->port = $port;
    }

    /**
     * @return string|null
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @param string|null $service
     */
    public function setService($service)
    {
        if (!is_null($service)) {
            $service = (string) $service;
        }
        $this->service = $service;
    }

    /**
     * @return string|null
     */
    public function getProtocol(): string
    {
        return $this->protocol;
    }

    /**
     * @param string|null $protocol
     */
    public function setProtocol($protocol)
    {
        if (!is_null($protocol)) {
            $protocol = (string) $protocol;
        }
        $this->protocol = $protocol;
    }

    /**
     * @return int|null
     */
    public function getTtl(): int
    {
        return $this->ttl;
    }

    /**
     * @param int|null $ttl
     */
    public function setTtl(int $ttl)
    {
        if (!is_null($ttl)) {
            if (0 > $ttl) {
                throw new \InvalidArgumentException(
                    __METHOD__ . '/ttl parameter must be an integer 0 or greater.'
                );
            }
            $ttl = (int)$ttl;
        }
        $this->ttl = $ttl;
    }

    /**
     * Transform the model data to an array.
     * This is useful when calling POST, PUT or PATCH endpoints.
     * Used primarily to send data TO an API endpoint, so null values are not included.
     * @return array
     */
    public function toArray(): array
    {
        $type = $this->getType();
        if (!is_null($type)) {
            $data['type'] = $this->getType();
        }
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
