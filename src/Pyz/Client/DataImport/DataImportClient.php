<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\DataImport;

use Generated\Shared\Transfer\RestDataImportsAttributesTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\DataImport\DataImportFactory getFactory()
 */
class DataImportClient extends AbstractClient implements DataImportClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer)
    {
        return $this->getFactory()->createZedStub()->import($restDataImportsAttributesTransfer);
    }
}
