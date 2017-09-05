<?php
/*
 * iDimensionz/{linode-api-v4}
 * KernelModel.php
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

namespace iDimensionz\LinodeApiV4\Api\Linode\Kernels;

class KernelModel
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $description;
    /**
     * @var bool
     */
    private $isXenCompatible;
    /**
     * @var bool
     */
    private $isKvmCompatible;
    /**
     * @var string
     */
    private $label;
    /**
     * @var string
     */
    private $version;
    /**
     * @var bool
     */
    private $isX64;
    /**
     * @var bool
     */
    private $isCurrent;
    /**
     * @var bool
     */
    private $isDeprecated;
    /**
     * @var bool
     */
    private $isLatest;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDescription(): string
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
     * @return bool
     */
    public function isXenCompatible(): bool
    {
        return $this->isXenCompatible;
    }

    /**
     * @param bool $isXenCompatible
     */
    public function setIsXenCompatible(bool $isXenCompatible)
    {
        $this->isXenCompatible = $isXenCompatible;
    }

    /**
     * @return bool
     */
    public function isKvmCompatible(): bool
    {
        return $this->isKvmCompatible;
    }

    /**
     * @param bool $isKvmCompatible
     */
    public function setIsKvmCompatible(bool $isKvmCompatible)
    {
        $this->isKvmCompatible = $isKvmCompatible;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = (string) $label;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = (string) $version;
    }

    /**
     * @return bool
     */
    public function isX64(): bool
    {
        return $this->isX64;
    }

    /**
     * @param bool $isX64
     */
    public function setIsX64(bool $isX64)
    {
        $this->isX64 = $isX64;
    }

    /**
     * @return bool
     */
    public function isCurrent(): bool
    {
        return $this->isCurrent;
    }

    /**
     * @param bool $isCurrent
     */
    public function setIsCurrent(bool $isCurrent)
    {
        $this->isCurrent = $isCurrent;
    }

    /**
     * @return bool
     */
    public function isDeprecated(): bool
    {
        return $this->isDeprecated;
    }

    /**
     * @param bool $isDeprecated
     */
    public function setIsDeprecated(bool $isDeprecated)
    {
        $this->isDeprecated = $isDeprecated;
    }

    /**
     * @return bool
     */
    public function isLatest(): bool
    {
        return $this->isLatest;
    }

    /**
     * @param bool $isLatest
     */
    public function setIsLatest(bool $isLatest)
    {
        $this->isLatest = $isLatest;
    }
}
