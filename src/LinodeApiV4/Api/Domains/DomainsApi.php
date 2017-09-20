<?php
/*
 * iDimensionz/{linode-api-v4}
 * Domains.php
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

namespace iDimensionz\LinodeApiV4\Api\Domains;

use iDimensionz\HttpClient\HttpClientInterface;
use iDimensionz\LinodeApiV4\LinodeApiEndpointAbstract;

class DomainsApi extends LinodeApiEndpointAbstract
{
    const ENDPOINT = 'domains';

    const DOMAIN_MODEL_CLASS_NAME = '\iDimensionz\LinodeApiV4\Api\Domains\DomainModel';

    public function __construct(HttpClientInterface $httpClient = null)
    {
        parent::__construct(self::ENDPOINT, $httpClient);
        $this->setModelClassName(self::DOMAIN_MODEL_CLASS_NAME);
    }

    /**
     * Get all domains for the account.
     * @todo implement filters based on filterable elements.
     * @return DomainModel[]
     */
    public function getAll(): array
    {
        // Don't need to specify a command here because the Domains API is simple.
        $httpResponse = $this->get();
        $data = $httpResponse->getBodyJsonAsArray();
        $domainData = $data['data'];
        $domainModels = [];
        if (is_array($domainData) && !empty($domainData)) {
            foreach ($domainData as $domainDatum) {
                $domainModel = $this->hydrate($domainDatum);
                $domainModels[] = $domainModel;
            }
        }

        return $domainModels;
    }

    /**
     * @param string $id
     * @return DomainModel
     */
    public function getById(string $id): DomainModel
    {
        $httpResponse = $this->get($id);
        $data = $httpResponse->getBodyJsonAsArray();
        $domainModel = $this->hydrate($data);

        return $domainModel;
    }

    /**
     * @param DomainModel $domainModel
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function create(DomainModel $domainModel): bool
    {
        // Verify required fields have values.
        if (!is_null($domainModel->getDomainName()) && !is_null($domainModel->getType())) {
            $data = $domainModel->toArray();
            $httpResponse = $this->post('', $data);
            $isSuccess = $httpResponse->isSuccess();
        } else {
            throw new \InvalidArgumentException(
                __METHOD__ . '/domain and type are required values for creating a domain.'
            );
        }

        return $isSuccess;
    }

    /**
     * @param int         $domainId
     * @param DomainModel $domainModel
     * @return bool
     */
    public function update(int $domainId, DomainModel $domainModel): bool
    {
        $data = $domainModel->toArray();
        $httpResponse = $this->put($domainId, $data);

        return $httpResponse->isSuccess();
    }

    /**
     * @param int $domainId
     * @return bool
     */
    public function remove(int $domainId)
    {
        $httpResponse = $this->delete($domainId);

        return $httpResponse->isSuccess();
    }

    /**
     * @param array $data
     * @return DomainModel
     */
    private function hydrate($data)
    {
        /**
         * @var DomainModel $model
         */
        $model = $this->createModel();
        $model->setType($data['type']);
        $model->setStatus($data['status']);
        $model->setDescription($data['description']);
        $model->setAxfrIps($data['axfr_ips']);
        $model->setTimeToLiveInterval($data['ttl_sec']);
        $model->setExpireInterval($data['expire_sec']);
        $model->setMasterIps($data['master_ips']);
        $model->setRefreshInterval($data['refresh_sec']);
        $model->setDomainName($data['domain']);
        $model->setRetryInterval($data['retry_sec']);
        $model->setGroup($data['group']);
        $model->setId($data['id']);
        $model->setSoaContactEmail($data['soa_email']);

        return $model;
    }
}
