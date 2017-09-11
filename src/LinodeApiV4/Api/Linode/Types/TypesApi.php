<?php
/*
 * iDimensionz/{linode-api-v4}
 * TypesApi.php
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

namespace iDimensionz\LinodeApiV4\Api\Linode\Types;

use iDimensionz\HttpClient\HttpClientInterface;
use iDimensionz\LinodeApiV4\LinodeApiEndpointAbstract;

class TypesApi extends LinodeApiEndpointAbstract
{
    const ENDPOINT = 'linode/types';

    const DOMAIN_MODEL_CLASS_NAME = '\iDimensionz\LinodeApiV4\Api\Linode\Types\TypeModel';

    /**
     * KernelsApi constructor.
     * @param HttpClientInterface|null $httpClient
     */
    public function __construct(HttpClientInterface $httpClient = null)
    {
        parent::__construct(self::ENDPOINT, $httpClient);
        $this->setModelClassName(self::DOMAIN_MODEL_CLASS_NAME);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $httpResponse = $this->get();
        $data = $httpResponse->getBodyJsonAsArray();

        $typesData = $data['types'];
        $typeModels = [];
        if (is_array($typesData) && !empty($typesData)) {
            foreach ($typesData as $typesDatum) {
                $typeModel = $this->hydrate($typesDatum);
                $typeModels[] = $typeModel;
            }
        }

        return $typeModels;
    }

    /**
     * @param string $id
     * @return TypeModel
     */
    public function getById($id): TypeModel
    {
        $httpResponse = $this->get($id);
        $data = $httpResponse->getBodyJsonAsArray();
        $typeModel = $this->hydrate($data);

        return $typeModel;
    }

    /**
     * @param array $data
     * @return TypeModel
     */
    private function hydrate(array $data): TypeModel
    {
        /**
         * @var TypeModel $model
         */
        $model = $this->createModel();
        $model->setId($data['id']);
        $model->setStorage($data['storage']);
        $model->setBackupsPrice($data['backups_price']);
        $model->setMemoryClass($data['class']);
        $model->setHourlyPrice($data['hourly_price']);
        $model->setLabel($data['label']);
        $model->setOutboundBandwidth($data['mbits_out']);
        $model->setMonthlyPrice($data['monthly_price']);
        $model->setRam($data['ram']);
        $model->setOutboundTransfer($data['transfer']);
        $model->setCpuCoreCount($data['vcpus']);

        return $model;
    }
}
