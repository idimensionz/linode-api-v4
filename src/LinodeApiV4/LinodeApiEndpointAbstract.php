<?php
/*
 * iDimensionz/{linode-api-v4}
 * LinodeApiEndpointAbstract.php
 *  
 * The MIT License (MIT)
 * 
 * Copyright (c) 2015 iDimensionz
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

namespace iDimensionz\LinodeApiV4;

use iDimensionz\Api\ApiEndpointAbstract;
use iDimensionz\HttpClient\HttpClientInterface;
use iDimensionz\LinodeApiV4\Api\Filters\FilterAbstract;

class LinodeApiEndpointAbstract extends ApiEndpointAbstract
{
    const LINODE_API_V4_URI = 'https://api.linode.com/v4/';

    /**
     * @var string
     */
    private $modelClassName;
    /**
     * @var FilterAbstract $filter
     */
    private $filter;

    /**
     * LinodeApiEndpointAbstract constructor.
     * @param string                    $endpoint
     * @param HttpClientInterface|null  $httpClient
     */
    public function __construct($endpoint, $httpClient = null)
    {
        $fullyQualifiedEndpoint = self::LINODE_API_V4_URI . $endpoint;
        parent::__construct($fullyQualifiedEndpoint, $httpClient);
        $this->setFilter(null);
    }

    /**
     * @return mixed
     */
    public function createModel()
    {
        $className = $this->getModelClassName();
        $model = new $className;

        return $model;
    }

    /**
     * @return string
     */
    public function getModelClassName()
    {
        return $this->modelClassName;
    }

    /**
     * @param string $modelClassName
     */
    public function setModelClassName($modelClassName)
    {
        $modelClassName = (string) $modelClassName;
        if (!class_exists($modelClassName)) {
            throw new \InvalidArgumentException(
                __METHOD__ . '/modelClassName must be the fully qualified class name of an existing class.'
            );
        }
        $this->modelClassName = $modelClassName;
    }

    /**
     * @return FilterAbstract
     */
    protected function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param FilterAbstract $filter
     */
    public function setFilter($filter = null)
    {
        if (!is_null($filter) && !$filter instanceof FilterAbstract) {
            throw new \InvalidArgumentException(__METHOD__ . '/filter must be an instance of FilterAbstract.');
        }
        $this->filter = $filter;
    }

    /**
     * @param string $command
     * @param array  $options
     * @return \iDimensionz\HttpClient\HttpResponse
     */
    public function get($command = '', $options = [])
    {
        /** @var FilterAbstract $filter */
        $filter = $this->getFilter();
        if (!empty($filter->getConditions())) {
            $filterHeader = $this->filter->getHeader();
            $options['headers'] = (isset($options['headers']) && is_array($options['headers']) ? $options['headers'] : []);
            $options['headers'] = array_merge($options['headers'] , $filterHeader);
        }

        return parent::get($command, $options);
    }
}
