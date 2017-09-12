<?php
/*
 * iDimensionz/{linode-api-v4}
 * RegionsApi.php
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

namespace iDimensionz\LinodeApiV4\Api\Regions;

use iDimensionz\HttpClient\HttpClientInterface;
use iDimensionz\LinodeApiV4\LinodeApiEndpointAbstract;

class RegionsApi extends LinodeApiEndpointAbstract
{
    const ENDPOINT = 'regions';

    const DOMAIN_MODEL_CLASS_NAME = '\iDimensionz\LinodeApiV4\Api\Regions\RegionModel';

    /**
     * RegionsApi constructor.
     * @param HttpClientInterface|null $httpClient
     */
    public function __construct($httpClient = null)
    {
        parent::__construct(self::ENDPOINT, $httpClient);
        $this->setModelClassName(self::DOMAIN_MODEL_CLASS_NAME);
    }

    /**
     * @return RegionModel[]
     */
    public function getAll()
    {
        $httpResponse = $this->get();
        $data = $httpResponse->getBodyJsonAsArray();

        $regionsData = $data['regions'];
        $regionModels = [];
        if (is_array($regionsData) && !empty($regionsData)) {
            foreach ($regionsData as $regionsDatum) {
                $regionModel = $this->hydrate($regionsDatum);
                $regionModels[] = $regionModel;
            }
        }

        return $regionModels;
    }

    /**
     * @param string $id
     * @return RegionModel
     */
    public function getById($id)
    {
        $httpResponse = $this->get($id);
        $data = $httpResponse->getBodyJsonAsArray();
        $regionModel = $this->hydrate($data);

        return $regionModel;
    }

    /**
     * @param array $data
     * @return RegionModel
     */
    protected function hydrate($data)
    {
        /**
         * @var RegionModel $model
         */
        $model = $this->createModel();
        $model->setId($data['id']);
        $model->setLabel($data['label']);
        $model->setCountry($data['country']);

        return $model;
    }
}
