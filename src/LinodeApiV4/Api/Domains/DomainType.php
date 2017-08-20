<?php
/*
 * iDimensionz/{linode-api-v4}
 * DomainType.php
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

class DomainType
{
    const MASTER = 'master';
    const SLAVE = 'slave';

    /**
     * @var string
     */
    private $type;

    public function __construct($type)
    {
        $this->setType($type);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        if (!$this->isValidType($type)) {
            throw new \InvalidArgumentException(
                __METHOD__ . '/type parameter must be one of ' . implode(', ', $this->getValidTypes())
            );
        }
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getValidTypes()
    {
        return array(self::MASTER, self::SLAVE);
    }

    /**
     * @param string $type
     * @return bool
     */
    public function isValidType($type)
    {
        return in_array($type, $this->getValidTypes());
    }
}
