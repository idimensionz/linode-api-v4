<?php
/*
 * iDimensionz/{linode-api-v4}
 * TypeFilter.php
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

namespace iDimensionz\LinodeApiV4\Api\Linode\Types\Filters;

use iDimensionz\LinodeApiV4\Api\Filters\FilterAbstract;
use iDimensionz\LinodeApiV4\Api\Filters\FilterFieldCondition\FilterFieldConditionNumber;
use iDimensionz\LinodeApiV4\Api\Filters\FilterFieldCondition\FilterFieldConditionString;
use PHPUnit\Util\Filter;

class TypeFilter extends FilterAbstract
{
    const FILTER_FIELD_STORAGE = 'storage';
    const FILTER_FIELD_HOURLY_PRICE = 'hourly_price';
    const FILTER_FIELD_LABEL = 'label';
    const FILTER_FIELD_OUTBOUND_BANDWIDTH = 'mbits_out';
    const FILTER_FIELD_MONTHLY_PRICE = 'monthly_price';
    const FILTER_FIELD_RAM = 'ram';
    const FILTER_FIELD_OUTBOUND_TRANSFER = 'transfer';
    const FILTER_FIELD_CPU_CORE_COUNT = 'vcpus';

    /**
     * TypeFilter constructor.
     * @param string $conditionOperator
     */
    public function __construct($conditionOperator = self::CONDITION_OPERATOR_AND)
    {
        $filterFields = [
            self::FILTER_FIELD_STORAGE              =>  FilterAbstract::FILTER_FIELD_TYPE_INTEGER,
//            self::FILTER_FIELD_HOURLY_PRICE       =>  FilterAbstract::FILTER_FIELD_TYPE_FLOAT,
            self::FILTER_FIELD_LABEL                =>  FilterAbstract::FILTER_FIELD_TYPE_STRING,
            self::FILTER_FIELD_OUTBOUND_BANDWIDTH   =>  FilterAbstract::FILTER_FIELD_TYPE_INTEGER,
            self::FILTER_FIELD_MONTHLY_PRICE        =>  FilterAbstract::FILTER_FIELD_TYPE_INTEGER,
            self::FILTER_FIELD_RAM                  =>  FilterAbstract::FILTER_FIELD_TYPE_INTEGER,
            self::FILTER_FIELD_OUTBOUND_TRANSFER    =>  FilterAbstract::FILTER_FIELD_TYPE_INTEGER,
            self::FILTER_FIELD_CPU_CORE_COUNT       =>  FilterAbstract::FILTER_FIELD_TYPE_INTEGER,
        ];
        $this->setFilterFields($filterFields);
        parent::__construct($conditionOperator);

    }

    /**
     * @param int $storage
     */
    public function addStorageFilter($storage)
    {
        $storage = (int) $storage;
        $this->addCondition(new FilterFieldConditionNumber(self::FILTER_FIELD_STORAGE, $storage));
    }

    /**
     * @param string $label
     */
    public function addLabelFilter($label)
    {
        $label = (string) $label;
        if (!empty($label)) {
            $this->addCondition( new FilterFieldConditionString(self::FILTER_FIELD_LABEL, $label));
        }
    }

    /**
     * @param int $outboundBandwidth
     */
    public function addOutboundBandwidthFilter($outboundBandwidth)
    {
        $outboundBandwidth = (int) $outboundBandwidth;
        $this->addCondition(
            new FilterFieldConditionNumber(self::FILTER_FIELD_OUTBOUND_BANDWIDTH, $outboundBandwidth)
        );
    }

    /**
     * @param int $monthlyPrice
     */
    public function addMonthlyPriceFilter($monthlyPrice)
    {
        $monthlyPrice = (int) $monthlyPrice;
        $this->addCondition(new FilterFieldConditionNumber(self::FILTER_FIELD_MONTHLY_PRICE, $monthlyPrice));
    }

    /**
     * @param int $ram
     */
    public function addRamFilter($ram)
    {
        $ram = (int) $ram;
        $this->addCondition(new FilterFieldConditionNumber(self::FILTER_FIELD_RAM, $ram));
    }

    /**
     * @param int $outboundTransfer
     */
    public function addOutboundTransferFilter($outboundTransfer)
    {
        $outboundTransfer = (int) $outboundTransfer;
        $this->addCondition(
            new FilterFieldConditionNumber(self::FILTER_FIELD_OUTBOUND_TRANSFER, $outboundTransfer)
        );
    }

    /**
     * @param $cpuCoreCount
     */
    public function addCpuCoreCountFilter($cpuCoreCount)
    {
        $cpuCoreCount = (int) $cpuCoreCount;
        $this->addCondition(
            new FilterFieldConditionNumber(FilterAbstract::FILTER_FIELD_TYPE_INTEGER, $cpuCoreCount)
        );
    }
}
