<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImportsRestApi\Business;

use Pyz\Zed\DataImportsRestApi\Business\Runner\DataImportRunner;
use Pyz\Zed\DataImportsRestApi\Business\Runner\DataImportRunnerInterface;
use Pyz\Zed\DataImportsRestApi\DataImportsRestApiDependencyProvider;
use Pyz\Zed\DataImportsRestApi\Dependency\Facade\DataImportsRestApiToDataImportFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\DataImportsRestApi\DataImportsRestApiConfig getConfig()
 */
class DataImportsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\DataImportsRestApi\Business\Runner\DataImportRunnerInterface
     */
    public function createDataImportRunner(): DataImportRunnerInterface
    {
        return new DataImportRunner(
            $this->getDataImportFacade(),
            $this->getConfig()
        );
    }

    /**
     * @return \Pyz\Zed\DataImportsRestApi\Dependency\Facade\DataImportsRestApiToDataImportFacadeInterface
     */
    public function getDataImportFacade(): DataImportsRestApiToDataImportFacadeInterface
    {
        return $this->getProvidedDependency(DataImportsRestApiDependencyProvider::FACADE_DATA_IMPORT);
    }
}
