<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\DataImport;

use Generated\Shared\Transfer\RestDataImportsAttributesTransfer;

interface DataImportClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer);
}
