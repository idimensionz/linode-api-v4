<?php
/*
 * iDimensionz/{linode-api-v4}
 * LinodeApiFilterConditionAbstract.php
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

namespace iDimensionz\LinodeApiV4\Filters;

abstract class FilterConditionAbstract implements \JsonSerializable
{
    const VALUE_TYPE_STRING = 'string';
    const VALUE_TYPE_NUMBER = 'number';
    const VALUE_TYPE_BOOL = 'bool';
    const VALUE_TYPE_OPERATOR_CONDITION = 'operator-condition';
    // A filter can be a condition of another filter creating complex filters.
    const VALUE_TYPE_FILTER = 'filter';

    /**
     * @var string  Indicates the type of the value (i.e. int, string, bool, condition)
     */
    private $valueType;
    /**
     * @var mixed
     */
    private $value;

    public function __construct($value, $valueType)
    {
        $this->setValue($value);
        $this->setValueType($valueType);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValueType()
    {
        return $this->valueType;
    }

    /**
     * @param string $valueType
     * @throws \InvalidArgumentException
     */
    public function setValueType($valueType)
    {
        if (!$this->isValidValueType($valueType)) {
            throw new \InvalidArgumentException(
                __METHOD__ . '/valueType must be one of ' . implode(', ', $this->getValidValueTypes())
            );
        }
        $this->valueType = (string) $valueType;
    }

    /**
     * @param string $valueType
     * @return bool
     */
    protected function isValidValueType($valueType)
    {
        return in_array((string) $valueType, $this->getValidValueTypes());
    }

    /**
     * @return array
     */
    protected function getValidValueTypes()
    {
        return [
            self::VALUE_TYPE_BOOL,
            self::VALUE_TYPE_NUMBER,
            self::VALUE_TYPE_STRING,
            self::VALUE_TYPE_OPERATOR_CONDITION,
            self::VALUE_TYPE_FILTER
        ];
    }
}
