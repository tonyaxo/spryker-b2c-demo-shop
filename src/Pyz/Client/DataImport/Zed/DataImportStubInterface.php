<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\DataImport\Zed;

use Generated\Shared\Transfer\RestDataImportsAttributesTransfer;

interface DataImportStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function import(RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer);
}
