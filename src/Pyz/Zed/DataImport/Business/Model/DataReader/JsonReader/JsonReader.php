<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\DataReader\JsonReader;

use Countable;
use Generated\Shared\Transfer\DataImporterReaderConfigurationTransfer;
use SplFileObject;
use Spryker\Zed\DataImport\Business\Exception\DataReaderException;
use Spryker\Zed\DataImport\Business\Model\DataReader\ConfigurableDataReaderInterface;
use Spryker\Zed\DataImport\Business\Model\DataReader\DataReaderInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class JsonReader implements DataReaderInterface, ConfigurableDataReaderInterface, Countable
{
    /**
     * @var \Pyz\Zed\DataImport\Business\Model\DataReader\JsonReader\JsonReaderConfigurationInterface
     */
    protected $jsonReaderConfiguration;

    /**
     * @var \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface
     */
    protected $dataSet;

    /**
     * @var int|null
     */
    protected $offset;

    /**
     * @var int|null
     */
    protected $limit;

    /**
     * @var array
     */
    protected array $jsonData = [];

    /**
     * @var int
     */
    protected int $position = 0;

    /**
     * @param \Pyz\Zed\DataImport\Business\Model\DataReader\JsonReader\JsonReaderConfigurationInterface $jsonReaderConfiguration
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     */
    public function __construct(JsonReaderConfigurationInterface $jsonReaderConfiguration, DataSetInterface $dataSet)
    {
        $this->jsonReaderConfiguration = $jsonReaderConfiguration;
        $this->dataSet = $dataSet;
        $this->configureReader();
    }

    /**
     * @return void
     */
    protected function configureReader()
    {
        $this->readJsonData();
        $this->openEnvelope();
        $this->rewind();
        $this->setOffsetAndLimit();
    }

    /**
     * @throws \Spryker\Zed\DataImport\Business\Exception\DataReaderException
     *
     * @return void
     */
    protected function readJsonData()
    {
        $fileName = $this->jsonReaderConfiguration->getFileName();

        if (!is_file($fileName) || !is_readable($fileName)) {
            throw new DataReaderException(sprintf('File "%s" could not be found or is not readable.', $fileName));
        }

        $fileObject = new SplFileObject($fileName);
        $rawData = $fileObject->fread($fileObject->getSize());
        $this->jsonData = json_decode($rawData, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @return void
     */
    protected function openEnvelope(): void
    {
        if ($this->jsonReaderConfiguration->hasEnvelope()) {
            $this->jsonData = $this->jsonData[$this->jsonReaderConfiguration->getEnvelopeName()];
        }
    }

    /**
     * @param \Generated\Shared\Transfer\DataImporterReaderConfigurationTransfer $dataImportReaderConfigurationTransfer
     *
     * @return $this
     */
    public function configure(DataImporterReaderConfigurationTransfer $dataImportReaderConfigurationTransfer)
    {
        $this->jsonReaderConfiguration->setDataImporterReaderConfigurationTransfer($dataImportReaderConfigurationTransfer);

        $this->configureReader();

        return $this;
    }

    /**
     * @return void
     */
    protected function setOffsetAndLimit()
    {
        $this->offset = $this->jsonReaderConfiguration->getOffset();
        $this->limit = $this->jsonReaderConfiguration->getLimit();
    }

    /**
     * @return void
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * @return int|mixed|null
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        if ($this->limit !== null && $this->limit !== 0) {
            if ($this->offset !== null) {
                return ($this->position + 1 < $this->offset + $this->limit);
            }
        }

        return isset($this->jsonData[$this->position]);
    }

    /**
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;

        if ($this->offset) {
            $this->position = $this->offset - 1;
        }
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface
     */
    public function current()
    {
        $dataSet = $this->jsonData[$this->position];
        $this->dataSet->exchangeArray($dataSet);

        return $this->dataSet;
    }

    /**
     * @return int|null
     */
    public function count()
    {
        return count($this->jsonData);
    }
}
