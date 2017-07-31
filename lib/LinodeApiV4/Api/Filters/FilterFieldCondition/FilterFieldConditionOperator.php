<?php
/*
 * iDimensionz/{linode-api-v4}
 * LinodeApiFilterConditionOperator.php
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

namespace iDimensionz\LinodeApiV4\Api\Filters\FilterFieldCondition;

class FilterFieldConditionOperator extends FilterFieldConditionAbstract
{
    const VALUE_OPERATOR_GREATER_THAN = '+gt';
    const VALUE_OPERATOR_GREATER_THAN_OR_EQUAL_TO = '+gte';
    const VALUE_OPERATOR_LESS_THAN = '+lt';
    const VALUE_OPERATOR_LESS_THAN_OR_EQUAL_TO = '+lte';
    const VALUE_OPERATOR_CONTAINS = '+contains';
    const VALUE_OPERATOR_NOT_EQUAL = '+neq';

    const ORDER_OPERATOR_ORDER_BY = '+order-by';
    const ORDER_OPERATOR_ORDER = '+order';

    const ORDER_ASCENDING = 'asc';
    const ORDER_DESCENDING = 'desc';

    const VALUE_OPERATOR_TYPE_ARRAY = 'array';
    const VALUE_OPERATOR_TYPE_NUMBER = 'number';
    const VALUE_OPERATOR_TYPE_STRING = 'string';
//  Need to find out how order operator works actually works.
    const OPERATOR_TYPE_ORDER = 'string';
    const OPERATOR_TYPE_ORDER_DIRECTION = 'order-direction';

    /**
     * @var array
     */
    private $valueOperatorTypes;

    /**
     * @param string $field
     * @param mixed  $value
     */
    public function __construct($field, $value)
    {
        parent::__construct($field, $value, self::VALUE_TYPE_OPERATOR_CONDITION);
        $operatorTypes = [
            self::VALUE_OPERATOR_GREATER_THAN             => self::VALUE_OPERATOR_TYPE_NUMBER,
            self::VALUE_OPERATOR_GREATER_THAN_OR_EQUAL_TO => self::VALUE_OPERATOR_TYPE_NUMBER,
            self::VALUE_OPERATOR_LESS_THAN                => self::VALUE_OPERATOR_TYPE_NUMBER,
            self::VALUE_OPERATOR_LESS_THAN_OR_EQUAL_TO    => self::VALUE_OPERATOR_TYPE_NUMBER,
            self::VALUE_OPERATOR_CONTAINS                 => self::VALUE_OPERATOR_TYPE_STRING,
            self::VALUE_OPERATOR_NOT_EQUAL                => self::VALUE_OPERATOR_TYPE_STRING,
            self::ORDER_OPERATOR_ORDER                    => self::OPERATOR_TYPE_ORDER_DIRECTION
        ];
        $this->setValueOperatorTypes($operatorTypes);
    }

    /**
     * @param string $key
     */
    public function setField($key)
    {
        if (!$this->isValidOperator($key)) {
            throw new \InvalidArgumentException(
                __METHOD__ . '/key parameter must be one of the following operators: ' .
                implode(', ', $this->getValidOperators())
            );
        }
        parent::setField($key);
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $operatorTypes = $this->getValueOperatorTypes();
        $key = $this->getField();
        // Make sure the value is the correct type for this operator.
        switch ($operatorTypes[$key]) {
            case self::VALUE_OPERATOR_TYPE_ARRAY:
                $isCorrectType = is_array($value);
                break;
            case self::VALUE_OPERATOR_TYPE_NUMBER:
                $isCorrectType = is_int($value) || is_float($value);
                break;
            case self::VALUE_OPERATOR_TYPE_STRING:
                $value = (string) $value;
                $isCorrectType = true;
                break;
            case self::OPERATOR_TYPE_ORDER_DIRECTION:
                $isCorrectType = in_array($value, array(self::ORDER_ASCENDING, self::ORDER_DESCENDING));
                break;
            default:
                $isCorrectType = false;
                break;
        }
        if ($isCorrectType) {
            parent::setValue($value);
        }
    }

    /**
     * @param string $operator
     * @return bool
     */
    public function isValidOperator($operator)
    {
        return in_array((string) $operator, $this->getValidOperators());
    }

    /**
     * @return array
     */
    public function getValidOperators()
    {
        return [
            self::CONDITION_OPERATOR_AND,
            self::CONDITION_OPERATOR_OR,
            self::VALUE_OPERATOR_GREATER_THAN,
            self::VALUE_OPERATOR_GREATER_THAN_OR_EQUAL_TO,
            self::VALUE_OPERATOR_LESS_THAN,
            self::VALUE_OPERATOR_LESS_THAN_OR_EQUAL_TO,
            self::VALUE_OPERATOR_CONTAINS,
            self::VALUE_OPERATOR_NOT_EQUAL
        ];
    }

    /**
     * @return array
     */
    public function getValueOperatorTypes()
    {
        return $this->valueOperatorTypes;
    }

    /**
     * @param array $valueOperatorTypes
     */
    public function setValueOperatorTypes($valueOperatorTypes)
    {
        $this->valueOperatorTypes = $valueOperatorTypes;
    }
}
