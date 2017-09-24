<?php
/*
 * iDimensionz/{linode-api-v4}
 * DomainRecordType.php
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


class DomainRecordType
{
    const TYPE_A = 'A';
    const TYPE_AAAA = 'AAAA';
    const TYPE_NS = 'NS';
    const TYPE_MX = 'MX';
    const TYPE_CNAME = 'CNAME';
    const TYPE_TXT = 'TXT';
    const TYPE_SRV = 'SRV';

    /**
     * @var string
     */
    private $recordType;

    /**
     * DomainRecordType constructor.
     * @param string $recordType
     */
    public function __construct(string $recordType)
    {
        $this->setRecordType($recordType);
    }

    /**
     * @return array
     */
    public function getValidRecordTypes()
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
    public function isValidRecordType(string $type): bool
    {
        return in_array($type, $this->getValidRecordTypes());
    }

    /**
     * @return string
     */
    public function getRecordType(): string
    {
        return $this->recordType;
    }

    /**
     * @param string $recordType
     * @throws \InvalidArgumentException
     */
    public function setRecordType(string $recordType)
    {
        if (!$this->isValidRecordType($recordType)) {
            throw new \InvalidArgumentException(
                __METHOD__ . '/recordType parameter must be one of ' . implode(', ', $this->getValidRecordTypes())
            );
        }
        $this->recordType = $recordType;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getRecordType();
    }
}
