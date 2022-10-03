<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\DataImportsRestApi\Processor\Runner;

use Generated\Shared\Transfer\RestDataImportsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface DataImportRunnerInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function triggerDataImport(
        RestRequestInterface $restRequest,
        RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer
    ): RestResponseInterface;
}
