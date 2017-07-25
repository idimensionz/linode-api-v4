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
use iDimensionz\Api\HttpClientInterface;

class LinodeApiEndpointAbstract extends ApiEndpointAbstract
{
    const LINODE_API_V4_URI = 'https://api.linode.com/v4/linode/';

    /**
     * @var string
     */
    private $modelClassName;

    public function __construct($httpClient, $endpoint)
    {
        $fullyQualifiedEndpoint = self::LINODE_API_V4_URI . $endpoint;
        parent::__construct($httpClient, $fullyQualifiedEndpoint);
    }

    /**
     * @return mixed
     */
    public function createModel()
    {
        $className = $this->getModelClassName();
        $model = new ($className);

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
}
