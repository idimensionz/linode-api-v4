<?php
/*
 * iDimensionz/{linode-api-v4}
 * TypeModel.php
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

namespace iDimensionz\LinodeApiV4\Api\Linode\Types;

class TypeModel
{
    const MEMORY_CLASS_STANDARD = 'standard';
    const MEMORY_CLASS_HIGH = 'himem';

    /**
     * @var string
     */
    private $id;
    /**
     * @var int
     */
    private $storage;
    /**
     * @var float
     */
    private $backupsPrice;
    /**
     * @var string
     */
    private $memoryClass;
    /**
     * @var float
     */
    private $hourlyPrice;
    /**
     * @var string
     */
    private $label;
    /**
     * @var int
     */
    private $outboundBandwidth;
    /**
     * @var int
     */
    private $monthlyPrice;
    /**
     * @var int
     */
    private $ram;
    /**
     * @var int
     */
    private $outboundTransfer;
    /**
     * @var int
     */
    private $cpuCoreCount;

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
     * @return int
     */
    public function getStorage(): int
    {
        return $this->storage;
    }

    /**
     * @param int $storage
     */
    public function setStorage(int $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @return float
     */
    public function getBackupsPrice(): float
    {
        return $this->backupsPrice;
    }

    /**
     * @param float $backupsPrice
     */
    public function setBackupsPrice(float $backupsPrice)
    {
        $this->backupsPrice = $backupsPrice;
    }

    /**
     * @return string
     */
    public function getMemoryClass(): string
    {
        return $this->memoryClass;
    }

    /**
     * @param string $memoryClass
     */
    public function setMemoryClass(string $memoryClass)
    {
        if (!empty($memoryClass)) {
            $validMemoryClasses = [self::MEMORY_CLASS_STANDARD, self::MEMORY_CLASS_HIGH];
            if (!in_array($memoryClass, $validMemoryClasses)) {
                throw new \InvalidArgumentException(__METHOD__ . '/memoryClass parameter must be one of ' .
                    implode(', ', $validMemoryClasses)
                );
            }
        }
        $this->memoryClass = $memoryClass;
    }

    /**
     * @return float
     */
    public function getHourlyPrice(): float
    {
        return $this->hourlyPrice;
    }

    /**
     * @param float $hourlyPrice
     */
    public function setHourlyPrice(float $hourlyPrice)
    {
        $this->hourlyPrice = $hourlyPrice;
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
     * @return int
     */
    public function getOutboundBandwidth(): int
    {
        return $this->outboundBandwidth;
    }

    /**
     * @param int $outboundBandwidth
     */
    public function setOutboundBandwidth(int $outboundBandwidth)
    {
        $this->outboundBandwidth = $outboundBandwidth;
    }

    /**
     * @return int
     */
    public function getMonthlyPrice(): int
    {
        return $this->monthlyPrice;
    }

    /**
     * @param int $monthlyPrice
     */
    public function setMonthlyPrice(int $monthlyPrice)
    {
        $this->monthlyPrice = $monthlyPrice;
    }

    /**
     * @return int
     */
    public function getRam(): int
    {
        return $this->ram;
    }

    /**
     * @param int $ram
     */
    public function setRam(int $ram)
    {
        $this->ram = $ram;
    }

    /**
     * @return int
     */
    public function getOutboundTransfer(): int
    {
        return $this->outboundTransfer;
    }

    /**
     * @param int $outboundTransfer
     */
    public function setOutboundTransfer(int $outboundTransfer)
    {
        $this->outboundTransfer = $outboundTransfer;
    }

    /**
     * @return int
     */
    public function getCpuCoreCount(): int
    {
        return $this->cpuCoreCount;
    }

    /**
     * @param int $cpuCoreCount
     */
    public function setCpuCoreCount(int $cpuCoreCount)
    {
        $this->cpuCoreCount = $cpuCoreCount;
    }
}
