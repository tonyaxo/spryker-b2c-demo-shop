<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\DataReader\JsonReader;

use Generated\Shared\Transfer\DataImporterReaderConfigurationTransfer;
use Spryker\Zed\DataImport\Business\Model\DataReader\FileResolver\FileResolverInterface;

class JsonReaderConfiguration implements JsonReaderConfigurationInterface
{
    /**
     * @var bool
     */
    public const DEFAULT_HAS_ENVELOP = true;

    /**
     * @var string
     */
    public const DEFAULT_ENVELOP = 'data';

    /**
     * @var \Generated\Shared\Transfer\DataImporterReaderConfigurationTransfer
     */
    protected $dataImporterReaderConfigurationTransfer;

    /**
     * @var \Spryker\Zed\DataImport\Business\Model\DataReader\FileResolver\FileResolverInterface
     */
    protected $fileResolver;

    /**
     * @param \Generated\Shared\Transfer\DataImporterReaderConfigurationTransfer $dataImporterReaderConfigurationTransfer
     * @param \Spryker\Zed\DataImport\Business\Model\DataReader\FileResolver\FileResolverInterface $fileResolver
     */
    public function __construct(DataImporterReaderConfigurationTransfer $dataImporterReaderConfigurationTransfer, FileResolverInterface $fileResolver)
    {
        $this->dataImporterReaderConfigurationTransfer = $dataImporterReaderConfigurationTransfer;
        $this->fileResolver = $fileResolver;
    }

    /**
     * @param \Generated\Shared\Transfer\DataImporterReaderConfigurationTransfer $dataImporterReaderConfigurationTransfer
     *
     * @return $this
     */
    public function setDataImporterReaderConfigurationTransfer(DataImporterReaderConfigurationTransfer $dataImporterReaderConfigurationTransfer)
    {
        $modified = $dataImporterReaderConfigurationTransfer->modifiedToArray();
        $modified = array_filter($modified, function ($value) {
            return ($value !== null);
        });
        $this->dataImporterReaderConfigurationTransfer->fromArray($modified);

        return $this;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileResolver->resolveFile($this->dataImporterReaderConfigurationTransfer);
    }

    /**
     * @return bool
     */
    public function hasEnvelope()
    {
        if ($this->dataImporterReaderConfigurationTransfer->getJsonHasEnvelope() !== null) {
            return $this->dataImporterReaderConfigurationTransfer->getJsonHasEnvelope();
        }

        return static::DEFAULT_HAS_ENVELOP;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return (int)$this->dataImporterReaderConfigurationTransfer->getOffset();
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return (int)$this->dataImporterReaderConfigurationTransfer->getLimit();
    }

    public function getEnvelopeName()
    {
        if ($this->dataImporterReaderConfigurationTransfer->getJsonEnvelope() !== null) {
            return $this->dataImporterReaderConfigurationTransfer->getJsonEnvelope();
        }

        return static::DEFAULT_ENVELOP;
    }
}
