<?php
/*
 * iDimensionz/{linode-api-v4}
 * DomainRecordsApi.php
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

namespace iDimensionz\LinodeApiV4\Api\Domains\Records;

use iDimensionz\HttpClient\HttpClientInterface;
use iDimensionz\LinodeApiV4\LinodeApiEndpointAbstract;

class DomainRecordsApi extends LinodeApiEndpointAbstract
{
    const ENDPOINT = 'domains';

    const DOMAIN_MODEL_CLASS_NAME = '\iDimensionz\LinodeApiV4\Api\Domains\DomainRecordModel';

    /**
     * DomainRecordsApi constructor.
     * @param HttpClientInterface|null $httpClient
     */
    public function __construct(HttpClientInterface $httpClient = null)
    {
        parent::__construct(self::ENDPOINT, $httpClient);
        $this->setModelClassName(self::DOMAIN_MODEL_CLASS_NAME);
    }

    /**
     * @param int $domainId
     * @return DomainRecordModel[]
     */
    public function getAll(int $domainId): array
    {
        $httpResponse = $this->get("$domainId/records");
        $data = $httpResponse->getBodyJsonAsArray();
        $domainRecords = [];
        if (is_array($data) && !empty($data)) {
            foreach ($data as $datum) {
                $domainRecord = $this->hydrate($datum);
                $domainRecords[] = $domainRecord;
            }
        }

        return $domainRecords;
    }

    /**
     * @param int $domainId
     * @param int $domainRecordId
     * @return DomainRecordModel
     */
    public function getById(int $domainId, int $domainRecordId): DomainRecordModel
    {
        $httpResponse = $this->get("$domainId/records/$domainRecordId");
        $data = $httpResponse->getBodyJsonAsArray();
        $domainRecordModel = $this->hydrate($data);

        return $domainRecordModel;
    }

    /**
     * @param int               $domainId
     * @param DomainRecordModel $domainRecordModel
     * @return bool
     */
    public function create(int $domainId, DomainRecordModel $domainRecordModel): bool
    {
        $data = json_encode($domainRecordModel);
        $httpResponse = $this->post("$domainId/records", $data);

        return $httpResponse->isSuccess();
    }

    /**
     * @param int               $domainId
     * @param DomainRecordModel $domainRecordModel
     * @return bool
     */
    public function update(int $domainId, DomainRecordModel $domainRecordModel): bool
    {
        $data = json_encode($domainRecordModel);
        $domainRecordId = $domainRecordModel->getId();
        $httpResponse = $this->put("$domainId/records/$domainRecordId", $data);

        return $httpResponse->isSuccess();
    }

    /**
     * @param int $domainId
     * @param int $domainRecordId
     * @return bool
     */
    public function remove(int $domainId, int $domainRecordId): bool
    {
        $httpResponse = $this->delete("$domainId/records/$domainRecordId");

        return $httpResponse->isSuccess();
    }

    /**
     * @param array $data
     * @return DomainRecordModel
     */
    protected function hydrate(array $data): DomainRecordModel
    {
        /**
         * @var DomainRecordModel $model
         */
        $model = $this->createModel();
        $model->setId($data['id']);
        $model->setType($data['type']);
        $model->setName($data['name']);
        $model->setTarget($data['target']);
        $model->setPriority($data['priority']);
        $model->setWeight($data['weight']);
        $model->setPort($data['port']);
        $model->setService($data['service']);
        $model->setProtocol($data['protocol']);
        $model->setTtl($data['ttl']);

        return $model;
    }
}
