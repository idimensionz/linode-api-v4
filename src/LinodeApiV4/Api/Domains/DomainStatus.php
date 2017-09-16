<?php
/*
 * iDimensionz/{linode-api-v4}
 * DomainStatus.php
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

namespace iDimensionz\LinodeApiV4\Api\Domains;

class DomainStatus
{
    const ACTIVE = 'active';
    const DISABLED = 'disabled';
    const EDIT_MODE = 'edit_mode';

    /**
     * @var string
     */
    private $status;

    /**
     * DomainStatus constructor.
     * @param string $status
     */
    public function __construct($status)
    {
        $this->setStatus($status);
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        if (!$this->isValidStatus($status)) {
            throw new \InvalidArgumentException(
                __METHOD__ . '/status must be one of ' . implode(', ', $this->getValidStatuses())
            );
        }
        $this->status = $status;
    }

    /**
     * @param string $status
     * @return bool
     */
    public function isValidStatus($status)
    {
        return in_array((string) $status, $this->getValidStatuses());
    }

    /**
     * @return array
     */
    public function getValidStatuses()
    {
        return [self::ACTIVE, self::DISABLED, self::EDIT_MODE];
    }

    public function __toString()
    {
        return $this->getStatus();
    }
}
