<?php
/*
 * iDimensionz/{linode-api-v4}
 * DistributionFilter.php
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

use iDimensionz\LinodeApiV4\Api\Filters\FilterAbstract;
use iDimensionz\LinodeApiV4\Api\Filters\FilterFieldCondition\FilterFieldConditionBoolean;
use iDimensionz\LinodeApiV4\Api\Filters\FilterFieldCondition\FilterFieldConditionNumber;
use iDimensionz\LinodeApiV4\Api\Filters\FilterFieldCondition\FilterFieldConditionString;

class DistributionFilter extends FilterAbstract
{
    const FILTER_FIELD_LABEL = 'label';
    const FILTER_FIELD_MINIMUM_STORAGE_SIZE = 'minimum_storage_size';
    const FILTER_FIELD_DEPRECATED = 'deprecated';
    const FILTER_FIELD_VENDOR = 'vendor';

    /**
     * DistributionFilter constructor.
     * @param string $conditionOperator
     */
    public function __construct($conditionOperator=self::CONDITION_OPERATOR_AND)
    {
        $filterFields = [
            self::FILTER_FIELD_LABEL                =>  FilterAbstract::FILTER_FIELD_TYPE_STRING,
            self::FILTER_FIELD_MINIMUM_STORAGE_SIZE =>  FilterAbstract::FILTER_FIELD_TYPE_INTEGER,
            self::FILTER_FIELD_DEPRECATED           =>  FilterAbstract::FILTER_FIELD_TYPE_BOOLEAN,
            self::FILTER_FIELD_VENDOR               =>  FilterAbstract::FILTER_FIELD_TYPE_STRING
        ];
        $this->setFilterFields($filterFields);
        parent::__construct($conditionOperator);
    }

    /**
     * @param string $label
     */
    public function addLabelFilter($label)
    {
        if (!empty($label)) {
            $this->addCondition(new FilterFieldConditionString(self::FILTER_FIELD_LABEL, $label));
        }
    }

    /**
     * @param int $minimumStorageSize
     */
    public function addMinimumStorageSizeFilter($minimumStorageSize)
    {
        $minimumStorageSize = (int) $minimumStorageSize;
        $this->addCondition(
            new FilterFieldConditionNumber(self::FILTER_FIELD_MINIMUM_STORAGE_SIZE, $minimumStorageSize)
        );
    }

    /**
     * @param bool $isDeprecated
     */
    public function addDeprecatedFilter($isDeprecated)
    {
        $isDeprecated = (bool) $isDeprecated;
        $this->addCondition(new FilterFieldConditionBoolean(self::FILTER_FIELD_DEPRECATED, $isDeprecated));
    }

    /**
     * @param string $vendor
     */
    public function addVendorFilter($vendor)
    {
        if(!empty($vendor)) {
            $this->addCondition(new FilterFieldConditionString(self::FILTER_FIELD_VENDOR, $vendor));
        }
    }
}
