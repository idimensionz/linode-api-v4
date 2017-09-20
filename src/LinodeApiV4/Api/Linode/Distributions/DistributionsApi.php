<?php
/*
 * iDimensionz/{linode-api-v4}
 * DistributionsApi.php
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

use iDimensionz\LinodeApiV4\LinodeApiEndpointAbstract;
use iDimensionz\HttpClient\HttpClientInterface;

class DistributionsApi extends LinodeApiEndpointAbstract
{
    const ENDPOINT = 'linode/distributions';

    const DOMAIN_MODEL_CLASS_NAME = '\iDimensionz\LinodeApiV4\Api\Linode\Distributions\DistributionModel';

    public function __construct(HttpClientInterface $httpClient = null)
    {
        parent::__construct(self::ENDPOINT, $httpClient);
        $this->setModelClassName(self::DOMAIN_MODEL_CLASS_NAME);
    }

    public function getAll()
    {
        $httpResponse = $this->get();
        $data = $httpResponse->getBodyJsonAsArray();

        $distributionsData = $data['data'];
        $distributionModels = [];
        if (is_array($distributionsData) && !empty($distributionsData)) {
            foreach ($distributionsData as $distributionsDatum) {
                $distributionModel = $this->hydrate($distributionsDatum);
                $distributionModels[] = $distributionModel;
            }
        }

        return $distributionModels;
    }

    /**
     * @param string $id
     * @return DistributionModel
     */
    public function getById($id)
    {
        $httpResponse = $this->get($id);
        $data = $httpResponse->getBodyJsonAsArray();
        $distributionModel = $this->hydrate($data);

        return $distributionModel;
    }

    private function hydrate($data)
    {
        /**
         * @var DistributionModel $model
         */
        $model = $this->createModel();
        $model->setId($data['id']);
        $model->setUpdated($data['updated']);
        $model->setLabel($data['label']);
        $model->setMinimumStorageSize($data['disk_minimum']);
        $model->setDeprecated($data['deprecated']);
        $model->setVendor($data['vendor']);
        $model->setArchitecture($data['architecture']);

        return $model;
    }
}
