<?php
/*
 * iDimensionz/{linode-api-v4}
 * LinodeApiFilterAbstract.php
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

namespace iDimensionz\LinodeApiV4\Api\Filters;

use iDimensionz\LinodeApiV4\Api\Filters\FilterConditionFilter;
use iDimensionz\LinodeApiV4\Api\Filters\FilterFieldCondition\FilterFieldConditionAbstract;

abstract class FilterAbstract implements \JsonSerializable
{
    const CONDITION_OPERATOR_AND = '+and';
    const CONDITION_OPERATOR_OR = '+or';

    const FILTER_FIELD_TYPE_INTEGER = 'Integer';
    const FILTER_FIELD_TYPE_STRING = 'String';
    const FILTER_FIELD_TYPE_ENUM = 'Enum';
    const FILTER_FIELD_TYPE_ARRAY_STRING = 'Array[string]';

    /**
     * @var array   Keys and types specific to the actual filter.
     */
    private $filterFields;
    /**
     * @var array   Array of valid values for Enum fields.
     */
    private $filterEnums;
    /**
     * @var array   Filter conditions
     */
    private $conditions;
    /**
     * @var array
     */
    private $conditionOperator;

    public function __construct($conditionOperator=self::CONDITION_OPERATOR_AND)
    {
        $this->setConditionOperator($conditionOperator);
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        $header = 'X-Filter: ' . json_encode($this);
        $headerString = $header;

        return $headerString;
    }

    /**
     * @return array
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * @param FilterConditionAbstract $condition
     */
    public function addCondition($condition)
    {
        if ($this->isValidCondition($condition)) {
            $this->conditions[] = $condition;
        };
    }

    /**
     * @return array
     */
    protected function getFilterFields()
    {
        return $this->filterFields;
    }

    /**
     * @param array $filterFields
     */
    protected function setFilterFields($filterFields)
    {
        $this->filterFields = $filterFields;
    }

    /**
     * @return array
     */
    protected function getFilterEnums()
    {
        return $this->filterEnums;
    }

    protected function getFilterEnum($field)
    {
        return $this->filterEnums[$field];
    }

    /**
     * @param array $filterEnums
     */
    public function setFilterEnums(array $filterEnums)
    {
        $this->filterEnums = $filterEnums;
    }

    /**
     * @param string    $field
     * @param mixed     $value
     */
    public function addFilterEnum($field, $value)
    {
        $this->filterEnums[$field] = $value;
    }

    /**
     * @return array
     */
    public function getConditionOperator()
    {
        return $this->conditionOperator;
    }

    /**
     * @param string $conditionOperator
     * @throws \InvalidArgumentException
     */
    public function setConditionOperator($conditionOperator)
    {
        if (!$this->isValidConditionOperator($conditionOperator)) {
            throw new \InvalidArgumentException(
                __METHOD__ . '/conditionOperator must be one of ' .
                implode(',', $this->getValidConditionOperators())
            );
        }
        $this->conditionOperator = $conditionOperator;
    }

    /**
     * @return array
     */
    public function getValidConditionOperators()
    {
        return [self::CONDITION_OPERATOR_AND, self::CONDITION_OPERATOR_OR];
    }

    /**
     * @param string $conditionOperator
     * @return bool
     */
    public function isValidConditionOperator($conditionOperator)
    {
        return in_array($conditionOperator, $this->getValidConditionOperators());
    }

    /**
     * @param FilterConditionAbstract $condition
     * @return bool
     */
    protected function isValidCondition($condition)
    {
        $isValidCondition = false;
        if ($condition instanceof FilterConditionAbstract) {
            if ($condition instanceof FilterConditionFilter) {
                $isValidCondition = true;
            } elseif ($condition instanceof FilterFieldConditionAbstract) {
                $filterFields = $this->getFilterFields();
                $filterField = $condition->getField();
                $value = $condition->getValue();
                switch ($filterFields[$filterField]) {
                    case self::FILTER_FIELD_TYPE_INTEGER:
                        $isValidCondition = is_int($value);
                        break;
                    case self::FILTER_FIELD_TYPE_STRING:
                        $value = (string)$value;
                        $isValidCondition = true;
                        break;
                    case self::FILTER_FIELD_TYPE_ARRAY_STRING:
                        $isValidCondition = is_array($value);
                        if ($isValidCondition) {
                            // Force each array item to string type.
                            foreach ($value as $key => $item) {
                                $value[$key] = (string)$item;
                            }
                        }
                        break;
                    case self::FILTER_FIELD_TYPE_ENUM:
                        $isValidCondition = in_array($value, $this->getFilterEnum($filterField));
                        break;
                    default:
                        $isValidCondition = false;
                        break;
                }
            }
        }

        return $isValidCondition;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $returnData = [];
        $conditions = $this->getConditions();
        $data = [];
        if (is_array($conditions) && !empty($conditions)) {
            if (self::CONDITION_OPERATOR_OR == $this->getConditionOperator()) {
                foreach ($conditions as $condition) {
                    $data[] = json_encode($condition);
                }
                $returnData = ['+or', $data];
            } elseif (self::CONDITION_OPERATOR_AND == $this->getConditionOperator()) {
                foreach ($conditions as $condition) {
                    $data = array_merge($data, json_encode($condition));
                }
                $returnData = ['+and', $data];
            }
        }

        return $returnData;
    }
}
