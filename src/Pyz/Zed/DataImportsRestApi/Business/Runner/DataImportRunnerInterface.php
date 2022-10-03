<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImportsRestApi\Business\Runner;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;

interface DataImportRunnerInterface
{
    /**
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfiguration
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function runImport(
        ?DataImporterConfigurationTransfer $dataImporterConfiguration = null
    ): DataImporterReportTransfer;
}
