<?php
/*
 * iDimensionz/{linode-api-v4}
 * DistributionModel.php
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

class DistributionModel
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var \DateTime
     */
    private $updated;
    /**
     * @var string
     */
    private $label;
    /**
     * @var int
     */
    private $minimumStorageSize;
    /**
     * @var bool
     */
    private $deprecated;
    /**
     * @var string
     */
    private $vendor;
    /**
     * @var DistributionArchitecture
     */
    private $architecture;

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
    public function setId($id)
    {
        $this->id = (string) $id;
    }

    /**
     * @return string
     */
    public function getVendor(): string
    {
        return $this->vendor;
    }

    /**
     * @param string $vendor
     */
    public function setVendor($vendor)
    {
        $this->vendor = (string) $vendor;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated($updated)
    {
        $dateTime = new \DateTime($updated);
        // @todo Add validation.
        $this->updated = $dateTime;
    }

    /**
     * @return bool
     */
    public function isDeprecated(): bool
    {
        return $this->deprecated;
    }

    /**
     * @param bool $deprecated
     */
    public function setDeprecated($deprecated)
    {
        $this->deprecated = (bool) $deprecated;
    }

    /**
     * @return int
     */
    public function getMinimumStorageSize(): int
    {
        return $this->minimumStorageSize;
    }

    /**
     * @param int $minimumStorageSize
     */
    public function setMinimumStorageSize($minimumStorageSize)
    {
        $this->minimumStorageSize = (int) $minimumStorageSize;
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
    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    /**
     * @return DistributionArchitecture
     */
    public function getArchitecture(): DistributionArchitecture
    {
        return $this->architecture;
    }

    /**
     * @param DistributionArchitecture $architecture
     */
    public function setArchitecture($architecture)
    {
        if (!is_null($architecture)) {
            $architecture = (string) $architecture;
            $distributionArchitecture = new DistributionArchitecture($architecture);
        } else {
            $distributionArchitecture = null;
        }
        $this->setDistributionArchitecture($distributionArchitecture);
    }

    /**
     * @param DistributionArchitecture|null $distributionArchitecture
     * @throws \InvalidArgumentException
     */
    public function setDistributionArchitecture($distributionArchitecture)
    {
        if (!is_null($distributionArchitecture)) {
            if (!$distributionArchitecture instanceof DistributionArchitecture) {
                throw new \InvalidArgumentException(
                    __METHOD__ .
                    '/distributionArchitecture parameter must be null or an instance of DistributionArchitecture.'
                );
            }
        }
        $this->architecture = $distributionArchitecture;
    }
}
