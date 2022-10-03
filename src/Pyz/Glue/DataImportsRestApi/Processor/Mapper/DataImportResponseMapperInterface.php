<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\DataImportsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\DataImporterReportMessageTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Generated\Shared\Transfer\RestDataImportsAttributesTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;

interface DataImportResponseMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\DataImporterReportTransfer $dataImporterReportTransfer
     * @param \Generated\Shared\Transfer\RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestDataImportsAttributesTransfer
     */
    public function mapDataImporterReportTransferToRestDataImportsAttributesTransfer(
        DataImporterReportTransfer $dataImporterReportTransfer,
        RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer
    ): RestDataImportsAttributesTransfer;

    /**
     * @param \Generated\Shared\Transfer\DataImporterReportMessageTransfer $dataImporterReportMessageTransfer
     * @param \Generated\Shared\Transfer\RestErrorMessageTransfer $restErrorMessageTransfer
     *
     * @return \Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    public function mapDataImporterReportMessageTransferToRestErrorTransfer(
        DataImporterReportMessageTransfer $dataImporterReportMessageTransfer,
        RestErrorMessageTransfer $restErrorMessageTransfer
    ): RestErrorMessageTransfer;
}
