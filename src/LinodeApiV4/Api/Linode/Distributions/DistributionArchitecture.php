<?php
/*
 * iDimensionz/{linode-api-v4}
 * DistributionArchitecture.php
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

namespace iDimensionz\LinodeApiV4\Api\Linode\Distributions;


class DistributionArchitecture
{
    const X86_64 = 'x86_64';
    const I386 = 'i386';

    /**
     * @var string
     */
    private $architecture;

    /**
     * DistributionArchitecture constructor.
     * @param string $architecture
     */
    public function __construct(string $architecture)
    {
        $this->setArchitecture($architecture);
    }

    /**
     * @return string
     */
    public function getArchitecture(): string
    {
        return $this->architecture;
    }

    /**
     * @param string $architecture
     * @throws \InvalidArgumentException
     */
    public function setArchitecture(string $architecture)
    {
        if (!$this->isValidArchitecture($architecture)) {
            throw new \InvalidArgumentException(
                __METHOD__ . 'architecture parameter must be one of ' .
                implode(', ', $this->getValidArchitectures()) . '.'
            );
        }
        $this->architecture = $architecture;
    }

    public function isValidArchitecture($architecture)
    {
        return in_array($architecture, $this->getValidArchitectures());
    }

    /**
     * @return array
     */
    public function getValidArchitectures()
    {
        return [self::X86_64, self::I386];
    }

    /**
     * @return array    Associative array of architecture and description.
     */
    public function getArchitectureDescriptions()
    {
        return [
            self::X86_64 =>  'a 64 bit distribution',
            self::I386   =>  'a 32 bit distribution'
        ];
    }

    public function __toString()
    {
        return $this->getArchitecture();
    }
}
