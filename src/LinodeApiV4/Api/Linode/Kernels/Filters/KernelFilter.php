<?php
/*
 * iDimensionz/{linode-api-v4}
 * KernelFilter.php
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

namespace iDimensionz\LinodeApiV4\Api\Linode\Kernels\Filters;

use iDimensionz\LinodeApiV4\Api\Filters\FilterAbstract;
use iDimensionz\LinodeApiV4\Api\Filters\FilterFieldCondition\FilterFieldConditionBoolean;
use iDimensionz\LinodeApiV4\Api\Filters\FilterFieldCondition\FilterFieldConditionString;

class KernelFilter extends FilterAbstract
{
    const FILTER_FIELD_XEN = 'xen';
    const FILTER_FIELD_KVM = 'kvm';
    const FILTER_FIELD_LABEL = 'label';
    const FILTER_FIELD_VERSION = 'version';
    const FILTER_FIELD_X64 = 'x64';
    const FILTER_FIELD_CURRENT = 'current';
    const FILTER_FIELD_DEPRECATED = 'deprecated';

    /**
     * KernelFilter constructor.
     */
    public function __construct()
    {
        $filterFields = [
            self::FILTER_FIELD_XEN          =>  FilterAbstract::FILTER_FIELD_TYPE_BOOLEAN,
            self::FILTER_FIELD_KVM          =>  FilterAbstract::FILTER_FIELD_TYPE_BOOLEAN,
            self::FILTER_FIELD_LABEL        =>  FilterAbstract::FILTER_FIELD_TYPE_STRING,
            self::FILTER_FIELD_VERSION      =>  FilterAbstract::FILTER_FIELD_TYPE_STRING,
            self::FILTER_FIELD_X64          =>  FilterAbstract::FILTER_FIELD_TYPE_BOOLEAN,
            self::FILTER_FIELD_CURRENT      =>  FilterAbstract::FILTER_FIELD_TYPE_BOOLEAN,
            self::FILTER_FIELD_DEPRECATED   =>  FilterAbstract::FILTER_FIELD_TYPE_BOOLEAN,
        ];
        $this->setFilterFields($filterFields);
        parent::__construct();
    }

    /**
     * @param bool $isXenCompatible
     */
    public function addXenFilter(bool $isXenCompatible)
    {
        $this->addCondition(new FilterFieldConditionBoolean(self::FILTER_FIELD_XEN, $isXenCompatible));
    }

    /**
     * @param bool $isKvmCompatible
     */
    public function addKvmFilter(bool $isKvmCompatible)
    {
        $this->addCondition(new FilterFieldConditionBoolean(self::FILTER_FIELD_KVM, $isKvmCompatible));
    }

    /**
     * @param $label
     */
    public function addLabelFilter($label)
    {
        if (!empty($label)) {
            $this->addCondition(new FilterFieldConditionString(self::FILTER_FIELD_LABEL, $label));
        }
    }

    /**
     * @param string $version
     */
    public function addVersionFilter($version)
    {
        $version = (string) $version;
        if (!empty($version)) {
            $this->addCondition(new FilterFieldConditionString(self::FILTER_FIELD_VERSION, $version));
        }
    }

    /**
     * @param bool $is64bit
     */
    public function addX64Filter(bool $is64bit)
    {
        $this->addCondition(new FilterFieldConditionBoolean(self::FILTER_FIELD_X64, $is64bit));
    }

    /**
     * @param bool $isCurrent
     */
    public function addCurrentFilter(bool $isCurrent)
    {
        $this->addCondition(new FilterFieldConditionBoolean(self::FILTER_FIELD_CURRENT, $isCurrent));
    }

    /**
     * @param bool $isDeprecated
     */
    public function addDeprecatedFilter(bool $isDeprecated)
    {
        $this->addCondition(new FilterFieldConditionBoolean(self::FILTER_FIELD_DEPRECATED, $isDeprecated));
    }
}
