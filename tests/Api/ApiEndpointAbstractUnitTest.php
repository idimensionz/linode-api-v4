<?php
/*
 * iDimensionz/{linode-api-v4}
 * ApiEndpointAbstractUnitTest.php
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

namespace iDimesionz\Tests\Api;

use iDimensionz\Api\ApiEndpointAbstract;
use iDimensionz\HttpClient\Guzzle\GuzzleHttpClient;
use iDimensionz\HttpClient\HttpResponse;
use PHPUnit\Framework\TestCase;
use iDimensionz\Tests\Api\ApiEndpointAbstractStub;

class ApiEndpointAbstractUnitTest extends TestCase
{
    const HTTP_CLIENT_CLASSNAME = '\iDimensionz\HttpClient\Guzzle\GuzzleHttpClient';
    const API_ENDPOINT_ABSTRACT_CLASSNAME = '\iDimensionz\Api\ApiEndpointAbstract';
    const API_ENDPOINT_ABSTRACT_STUB_CLASSNAME = '\iDimensionz\Tests\Api\ApiEndpointAbstractStub';
    const HTTP_RESPONSE = '\iDimensionz\HttpClient\HttpResponse';

    /**
     * @var ApiEndpointAbstractStub
     */
    private $apiEndpointAbstract;
    /**
     * @var GuzzleHttpClient|\Phake_IMock
     */
    private $httpClient;
    /**
     * @var HttpResponse
     */
    private $httpResponse;
    /**
     * @var string
     */
    private $validEndpoint;

    public function setUp()
    {
         parent::setUp();
         $this->validEndpoint = 'some-endpoint';
    }

    public function tearDown()
    {
        unset($this->validEndpoint);
        unset($this->apiEndpointAbstract);
        unset($this->httpClient);
        parent::tearDown();
    }

    public function testConstruct()
    {
        $this->hasApiEndpointAbstract($this->validEndpoint);
        $this->assertInstanceOf(self::API_ENDPOINT_ABSTRACT_CLASSNAME, $this->apiEndpointAbstract);
    }

    public function testEndpointGetterAndSetter()
    {
        // The setter should typecast the endpoint to a string so verify that.
        $potentialEndpoints = [
            null, 0, 1.314, 'iman_endpoint'
        ];
        $this->hasApiEndpointAbstract();
        foreach ($potentialEndpoints as $potentialEndpoint) {
            $this->apiEndpointAbstract->setEndpoint($potentialEndpoint);
            $this->assertEquals((string) $potentialEndpoint, $this->apiEndpointAbstract->getEndpoint());
        }
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testHttpClientSetterThrowsExceptionWhenParameterInvalid()
    {
        $this->hasApiEndpointAbstract('');
        $this->apiEndpointAbstract->setHttpClient('This is not an HTTP client');
    }

    public function testHttpClientGetterAndSetterWhenParameterSupplied()
    {
        $this->hasApiEndpointAbstract('');
        $actualHttpClient = $this->apiEndpointAbstract->getHttpClient();
        $this->assertInstanceOf('\Phake_IMock', $actualHttpClient);
        $this->assertInstanceOf(self::HTTP_CLIENT_CLASSNAME, $actualHttpClient);
    }

    public function testHttpClientGetterAndSetterWhenParameterNotSupplied()
    {
        $this->hasApiEndpointAbstract('');
        $this->apiEndpointAbstract->setHttpClient();
        $actualHttpClient = $this->apiEndpointAbstract->getHttpClient();
        $this->assertInstanceOf(self::HTTP_CLIENT_CLASSNAME, $actualHttpClient);
        $this->assertTrue(!$actualHttpClient instanceof \Phake_IMock);
    }

    public function testGetWithEmptyParameters()
    {
        $this->hasApiEndpointAbstract($this->validEndpoint);
        $actualResponse = $this->apiEndpointAbstract->get();
        \Phake::verify($this->httpClient)->get($this->validEndpoint, []);
        $this->assertInstanceOf(self::HTTP_RESPONSE, $actualResponse);
    }

    public function testGetWithParameters()
    {
        $this->hasApiEndpointAbstract($this->validEndpoint);
        $validCommand = 'some-command';
        $validOptions = ['valid-options'];
        $actualResponse = $this->apiEndpointAbstract->get($validCommand, $validOptions);
        \Phake::verify($this->httpClient)->get($this->validEndpoint . '/' . $validCommand, $validOptions);
        $this->assertInstanceOf(self::HTTP_RESPONSE, $actualResponse);
    }

    public function testPatchWithEmptyCommandParameter()
    {
        $this->hasApiEndpointAbstract($this->validEndpoint);
        $validData = ['some-data'];
        $actualResponse = $this->apiEndpointAbstract->patch('', $validData);
        \Phake::verify($this->httpClient)->patch($this->validEndpoint, ['json' => $validData]);
        $this->assertInstanceOf(self::HTTP_RESPONSE, $actualResponse);
    }

    public function testPatchWithCommandParameter()
    {
        $this->hasApiEndpointAbstract($this->validEndpoint);
        $validCommand = 'some-command';
        $validData = ['valid-data'];
        $actualResponse = $this->apiEndpointAbstract->patch($validCommand, $validData);
        \Phake::verify($this->httpClient)->patch($this->validEndpoint . '/' . $validCommand, ['json' => $validData]);
        $this->assertInstanceOf(self::HTTP_RESPONSE, $actualResponse);
    }

    public function testPostWithEmptyCommandParameter()
    {
        $this->hasApiEndpointAbstract($this->validEndpoint);
        $validData = ['some-data'];
        $actualResponse = $this->apiEndpointAbstract->post('', $validData);
        \Phake::verify($this->httpClient)->post($this->validEndpoint, ['json' => $validData]);
        $this->assertInstanceOf(self::HTTP_RESPONSE, $actualResponse);
    }

    public function testPostWithCommandParameter()
    {
        $this->hasApiEndpointAbstract($this->validEndpoint);
        $validCommand = 'some-command';
        $validData = ['valid-data'];
        $actualResponse = $this->apiEndpointAbstract->post($validCommand, $validData);
        \Phake::verify($this->httpClient)->post($this->validEndpoint . '/' . $validCommand, ['json' => $validData]);
        $this->assertInstanceOf(self::HTTP_RESPONSE, $actualResponse);
    }

    public function testDeleteWithEmptyCommandParameter()
    {
        $this->hasApiEndpointAbstract($this->validEndpoint);
        $actualResponse = $this->apiEndpointAbstract->delete('');
        \Phake::verify($this->httpClient)->delete($this->validEndpoint);
        $this->assertInstanceOf(self::HTTP_RESPONSE, $actualResponse);
    }

    public function testDeleteWithCommandParameter()
    {
        $this->hasApiEndpointAbstract($this->validEndpoint);
        $validCommand = 'some-command';
        $actualResponse = $this->apiEndpointAbstract->delete($validCommand);
        \Phake::verify($this->httpClient)->delete($this->validEndpoint . '/' . $validCommand);
        $this->assertInstanceOf(self::HTTP_RESPONSE, $actualResponse);
    }

    /**
     * Helper functions
     */

    private function hasHttpClient()
    {
        $this->httpClient = \Phake::mock(self::HTTP_CLIENT_CLASSNAME);
        $this->hasHttpResponse();
        \Phake::when($this->httpClient)->get(\Phake::anyParameters())
            ->thenReturn($this->httpResponse);
        \Phake::when($this->httpClient)->patch(\Phake::anyParameters())
            ->thenReturn($this->httpResponse);
        \Phake::when($this->httpClient)->post(\Phake::anyParameters())
            ->thenReturn($this->httpResponse);
        \Phake::when($this->httpClient)->delete(\Phake::anyParameters())
            ->thenReturn($this->httpResponse);
    }

    private function hasHttpResponse()
    {
        $this->httpResponse = \Phake::mock(self::HTTP_RESPONSE);
    }

    private function hasApiEndpointAbstract($endPoint = '')
    {
        $this->hasHttpClient();
        $className = self::API_ENDPOINT_ABSTRACT_STUB_CLASSNAME;
        $this->apiEndpointAbstract = new $className($endPoint, $this->httpClient);
    }
}
