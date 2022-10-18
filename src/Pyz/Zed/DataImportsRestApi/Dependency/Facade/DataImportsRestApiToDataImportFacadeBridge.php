<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImportsRestApi\Dependency\Facade;

use Generated\Shared\Transfer\DataImportConfigurationActionTransfer;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Pyz\Zed\DataImport\Business\DataImportFacadeInterface;

class DataImportsRestApiToDataImportFacadeBridge implements DataImportsRestApiToDataImportFacadeInterface
{
    /**
     * @var \Pyz\Zed\DataImport\Business\DataImportFacadeInterface
     */
    protected $dataImportFacade;

    /**
     * @param \Pyz\Zed\DataImport\Business\DataImportFacadeInterface $dataImportFacade
     */
    public function __construct(DataImportFacadeInterface $dataImportFacade)
    {
        $this->dataImportFacade = $dataImportFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\DataImportConfigurationActionTransfer $dataImportConfigurationActionTransfer
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfiguration
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function importByAction(
        DataImportConfigurationActionTransfer $dataImportConfigurationActionTransfer,
        ?DataImporterConfigurationTransfer $dataImporterConfiguration = null
    ): DataImporterReportTransfer {
        return $this->dataImportFacade
            ->importByAction($dataImportConfigurationActionTransfer, $dataImporterConfiguration);
    }
}
