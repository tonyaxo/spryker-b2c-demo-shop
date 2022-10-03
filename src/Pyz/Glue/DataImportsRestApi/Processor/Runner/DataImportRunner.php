<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\DataImportsRestApi\Processor\Runner;

use ArrayObject;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Generated\Shared\Transfer\RestDataImportsAttributesTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Pyz\Client\DataImport\DataImportClientInterface;
use Pyz\Glue\DataImportsRestApi\DataImportsRestApiConfig;
use Pyz\Glue\DataImportsRestApi\Processor\Mapper\DataImportResponseMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class DataImportRunner implements DataImportRunnerInterface
{
    /**
     * @var \Pyz\Client\DataImport\DataImportClientInterface
     */
    protected DataImportClientInterface $dataImportClient;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected RestResourceBuilderInterface $restResourceBuilder;

    /**
     * @var \Pyz\Glue\DataImportsRestApi\Processor\Mapper\DataImportResponseMapperInterface
     */
    protected DataImportResponseMapperInterface $dataImportResponseMapper;

    /**
     * @param \Pyz\Glue\DataImportsRestApi\Processor\Mapper\DataImportResponseMapperInterface $dataImportResponseMapper
     * @param \Pyz\Client\DataImport\DataImportClientInterface $dataImportClient
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        DataImportResponseMapperInterface $dataImportResponseMapper,
        DataImportClientInterface $dataImportClient,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->dataImportResponseMapper = $dataImportResponseMapper;
        $this->dataImportClient = $dataImportClient;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function triggerDataImport(
        RestRequestInterface $restRequest,
        RestDataImportsAttributesTransfer $restDataImportsAttributesTransfer
    ): RestResponseInterface {
        $dataImporterReportTransfer = $this->dataImportClient
            ->import($restDataImportsAttributesTransfer);

        if (!$dataImporterReportTransfer->getIsSuccess()) {
            return $this->createPlaceOrderFailedErrorResponse($dataImporterReportTransfer->getMessages());
        }

        return $this->createDataImportResponse($dataImporterReportTransfer);
    }

    /**
     * @param \ArrayObject<int, \Generated\Shared\Transfer\RestCheckoutErrorTransfer> $errors
     * @param string $localeName
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createPlaceOrderFailedErrorResponse(ArrayObject $errors): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        foreach ($errors as $restCheckoutErrorTransfer) {
            $restResponse->addError(
                $this->dataImportResponseMapper->mapDataImporterReportMessageTransferToRestErrorTransfer(
                    $restCheckoutErrorTransfer,
                    new RestErrorMessageTransfer(),
                ),
            );
        }

        return $restResponse;
    }

    /**
     * @param \Generated\Shared\Transfer\DataImporterReportTransfer $dataImporterReportTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createDataImportResponse(DataImporterReportTransfer $dataImporterReportTransfer): RestResponseInterface
    {
        $restDataImportsAttributesTransfer = $this->dataImportResponseMapper
            ->mapDataImporterReportTransferToRestDataImportsAttributesTransfer(
                $dataImporterReportTransfer,
                new RestDataImportsAttributesTransfer(),
            );

        $restResource = $this->restResourceBuilder->createRestResource(
            DataImportsRestApiConfig::RESOURCE_DATA_IMPORTS,
            null,
            $restDataImportsAttributesTransfer,
        );

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addResource($restResource);
    }
}
