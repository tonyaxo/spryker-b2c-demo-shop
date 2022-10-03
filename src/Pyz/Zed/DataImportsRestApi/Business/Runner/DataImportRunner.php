<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImportsRestApi\Business\Runner;

use Generated\Shared\Transfer\DataImportConfigurationActionTransfer;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Pyz\Zed\DataImportsRestApi\DataImportsRestApiConfig;
use Pyz\Zed\DataImportsRestApi\Dependency\Facade\DataImportsRestApiToDataImportFacadeInterface;

class DataImportRunner implements DataImportRunnerInterface
{
    /**
     * @var \Pyz\Zed\DataImportsRestApi\Dependency\Facade\DataImportsRestApiToDataImportFacadeInterface
     */
    protected DataImportsRestApiToDataImportFacadeInterface $dataImportFacade;

    /**
     * @var \Pyz\Zed\DataImportsRestApi\DataImportsRestApiConfig
     */
    protected DataImportsRestApiConfig $config;

    /**
     * @param \Pyz\Zed\DataImportsRestApi\Dependency\Facade\DataImportsRestApiToDataImportFacadeInterface $dataImportFacade
     * @param \Pyz\Zed\DataImportsRestApi\DataImportsRestApiConfig $config
     */
    public function __construct(
        DataImportsRestApiToDataImportFacadeInterface $dataImportFacade,
        DataImportsRestApiConfig $config
    ) {
        $this->dataImportFacade = $dataImportFacade;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfiguration
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function runImport(
        ?DataImporterConfigurationTransfer $dataImporterConfiguration = null
    ): DataImporterReportTransfer {
        $dataImportConfigurationActionTransfer = (new DataImportConfigurationActionTransfer())
            ->setDataEntity($this->config->getDefaultImportType())
            ->setSource($this->config->getDefaultDataImportCsvPath());

        return $this->dataImportFacade->importByAction($dataImportConfigurationActionTransfer, $dataImporterConfiguration);
    }
}
