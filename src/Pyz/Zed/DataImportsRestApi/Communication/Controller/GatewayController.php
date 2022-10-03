<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImportsRestApi\Communication\Controller;

use Generated\Shared\Transfer\RestDataImportsAttributesTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Pyz\Zed\DataImportsRestApi\Business\DataImportsRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function importAction(RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer)
    {
        $dataImporterReportTransfer = $this->getFacade()->import();
        $this->setSuccess($dataImporterReportTransfer->getIsSuccess());

        return $dataImporterReportTransfer;
    }
}
