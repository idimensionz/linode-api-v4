<?php
/*
 * iDimensionz/{linode-api-v4}
 * ApiEndpointAbstract.php
 *  
 * The MIT License (MIT)
 * 
 * Copyright (c) 2017 iDimensionz
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

namespace iDimensionz\Api;

use iDimensionz\HttpClient\HttpClientInterface;
use iDimensionz\HttpClient\HttpResponse;

abstract class ApiEndpointAbstract
{
    /**
     * @var string $endpoint
     */
    private $endpoint;
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @param HttpClientInterface $httpClient
     * @param string              $endpoint
     */
    public function __construct($httpClient, $endpoint)
    {
        $this->setHttpClient($httpClient);
        $this->setEndpoint($endpoint);
    }

    /**
     * @param string $command
     * @return HttpResponse
     */
    public function get($command)
    {
        if (!empty($command)) {
            $command = "/{$command}";
        }
        $httpResponse = $this->getHttpClient()->get($this->getEndpoint() . $command);
        return $httpResponse;
    }

    /**
     * @param string $command
     * @param string $data JSON encoded data
     * @return HttpResponse
     */
    public function patch($command, $data)
    {
        $body = [
            'body' => $data
        ];
        if (!empty($command)) {
            $command = "/{$command}";
        }
        $httpResponse = $this->getHttpClient()->patch($this->getEndpoint() . $command, $body);

        return $httpResponse;
    }

    /**
     * @param string $command
     * @param string $data  JSON encoded data
     * @return HttpResponse
     */
    public function post($command, $data)
    {
        $body = [
            'body'  =>  $data
        ];
        if (!empty($command)) {
            $command = "/{$command}";
        }
        $httpResponse = $this->getHttpClient()->post($this->getEndpoint() . $command, $body);

        return $httpResponse;
    }

    /**
     * @param $command
     * @return array|string
     */
    public function delete($command)
    {
        if (!empty($command)) {
            $command = "/{$command}";
        }
        $httpResponse = $this->getHttpClient()->delete($this->getEndpoint() . $command);

        return $httpResponse;
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = (string) $endpoint;
    }

    /**
     * @return HttpClientInterface
     */
    protected function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param HttpClientInterface $httpClient
     */
    public function setHttpClient($httpClient)
    {
        if (!$httpClient instanceof HttpClientInterface) {
            throw new \InvalidArgumentException(
                __METHOD__ . '/httpClient parameter must implement the HttpClientInterface.'
            );
        }
        $this->httpClient = $httpClient;
    }
}
