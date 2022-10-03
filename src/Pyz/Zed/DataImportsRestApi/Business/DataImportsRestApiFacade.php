<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImportsRestApi\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @api
 *
 * @method \Pyz\Zed\DataImportsRestApi\Business\DataImportsRestApiBusinessFactory getFactory()
 */
class DataImportsRestApiFacade extends AbstractFacade implements DataImportsRestApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfiguration
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(
        ?DataImporterConfigurationTransfer $dataImporterConfiguration = null
    ): DataImporterReportTransfer {
        return $this->getFactory()
            ->createDataImportRunner()
            ->runImport($dataImporterConfiguration);
    }
}
