<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\DataImportsRestApi;

use Pyz\Client\DataImport\DataImportClientInterface;
use Pyz\Glue\DataImportsRestApi\Processor\Mapper\DataImportResponseMapper;
use Pyz\Glue\DataImportsRestApi\Processor\Mapper\DataImportResponseMapperInterface;
use Pyz\Glue\DataImportsRestApi\Processor\Runner\DataImportRunner;
use Pyz\Glue\DataImportsRestApi\Processor\Runner\DataImportRunnerInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \Pyz\Glue\DataImportsRestApi\DataImportsRestApiConfig getConfig()
 */
class DataImportsRestApiFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Glue\DataImportsRestApi\Processor\Mapper\DataImportResponseMapperInterface
     */
    public function createDataImportResourceMapper(): DataImportResponseMapperInterface
    {
        return new DataImportResponseMapper();
    }

    /**
     * @return \Pyz\Glue\DataImportsRestApi\Processor\Runner\DataImportRunnerInterface
     */
    public function createDataImportRunner(): DataImportRunnerInterface
    {
        return new DataImportRunner(
            $this->createDataImportResourceMapper(),
            $this->getDataImportClient(),
            $this->getResourceBuilder(),
        );
    }

    /**
     * @return \Pyz\Client\DataImport\DataImportClientInterface
     */
    public function getDataImportClient(): DataImportClientInterface
    {
        return $this->getProvidedDependency(DataImportsRestApiDependencyProvider::CLIENT_DATA_IMPORT);
    }
}
