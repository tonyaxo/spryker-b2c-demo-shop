<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\DataImportsRestApi\Controller;

use Generated\Shared\Transfer\RestDataImportsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \Pyz\Glue\DataImportsRestApi\DataImportsRestApiFactory getFactory()
 */
class DataImportResourceController extends AbstractController
{
    /**
     * @Glue({
     *     "post": {
     *          "summary": [
     *              "Trigger example product import"
     *          ],
     *          "responses": {
     *              "404": "Import not found"
     *          }
     *          "responseAttributesClassName": "\\Generated\\Shared\\Transfer\\RestDataImportsAttributesTransfer",
     *          "isIdNullable": true
     *     }
     * })
     *
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function postAction(RestRequestInterface $restRequest, RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer): RestResponseInterface
    {
        return $this->getFactory()
            ->createDataImportRunner()
            ->triggerDataImport($restRequest, $restDataImportsAttributesTransfer);
    }
}
