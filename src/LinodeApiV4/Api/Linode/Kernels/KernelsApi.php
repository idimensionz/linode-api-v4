<?php
/*
 * iDimensionz/{linode-api-v4}
 * KernelsApi.php
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

namespace iDimensionz\LinodeApiV4\Api\Linode\Kernels;

use iDimensionz\LinodeApiV4\LinodeApiEndpointAbstract;
use iDimensionz\HttpClient\HttpClientInterface;

class KernelsApi extends LinodeApiEndpointAbstract
{
    const ENDPOINT = 'linode/kernels';

    const DOMAIN_MODEL_CLASS_NAME = '\iDimensionz\LinodeApiV4\Api\Linode\Kernels\KernelModel';

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

        $kernelsData = $data['kernels'];
        $kernelModels = [];
        if (is_array($kernelsData) && !empty($kernelsData)) {
            foreach ($kernelsData as $kernelsDatum) {
                $kernelModel = $this->hydrate($kernelsDatum);
                $kernelModels[] = $kernelModel;
            }
        }

        return $kernelModels;
    }

    /**
     * @param string $id
     * @return KernelModel
     */
    public function getById($id): KernelModel
    {
        $httpResponse = $this->get($id);
        $data = $httpResponse->getBodyJsonAsArray();
        $kernelModel = $this->hydrate($data);

        return $kernelModel;
    }

    /**
     * @param array $data
     * @return KernelModel
     */
    private function hydrate(array $data): KernelModel
    {
        /**
         * @var KernelModel $model
         */
        $model = $this->createModel();
        $model->setId($data['id']);
        $model->setDescription($data['description']);
        $model->setIsXenCompatible($data['xen']);
        $model->setIsKvmCompatible($data['kvm']);
        $model->setLabel($data['label']);
        $model->setVersion($data['version']);
        $model->setArchitecture($data['x64']);
        $model->setIsCurrent($data['current']);
        $model->setIsDeprecated($data['deprecated']);
        $model->setIsLatest($data['latest']);

        return $model;
    }
}
