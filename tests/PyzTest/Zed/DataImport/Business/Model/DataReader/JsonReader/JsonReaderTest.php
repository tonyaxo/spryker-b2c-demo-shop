<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\DataImport\Business\Model\DataReader\JsonReader;

use Codeception\Configuration;
use Codeception\Test\Unit;
use Countable;
use Generated\Shared\Transfer\DataImporterReaderConfigurationTransfer;
use Spryker\Zed\DataImport\Business\Exception\DataReaderException;
use Spryker\Zed\DataImport\Business\Model\DataReader\CsvReader\CsvReaderConfiguration;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSet;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group DataImport
 * @group Business
 * @group Model
 * @group DataReader
 * @group JsonReader
 * @group JsonReaderTest
 * Add your own group annotations below this line
 */
class JsonReaderTest extends Unit
{
    /**
     * @var int
     */
    public const EXPECTED_NUMBER_OF_DATA_SETS_IN_JSON = 3;

    /**
     * @var \PyzTest\Zed\DataImport\DataImportBusinessTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testDataReaderCanBeUsedAsIteratorAndReturnsArrayObject(): void
    {
        $jsonReader = $this->getJsonReader(Configuration::dataDir() . 'import-standard.json');
        foreach ($jsonReader as $dataSet) {
            $this->assertInstanceOf(DataSet::class, $dataSet);
        }
    }

    /**
     * @return void
     */
    public function testReaderIsCountable(): void
    {
        $jsonReader = $this->getJsonReader(Configuration::dataDir() . 'import-standard.json');
        $this->assertInstanceOf(Countable::class, $jsonReader);
    }

    /**
     * @return void
     */
    public function testDataReaderCount(): void
    {
        $jsonReader = $this->getJsonReader(Configuration::dataDir() . 'import-standard.json');
        $this->tester->assertDataSetCount(static::EXPECTED_NUMBER_OF_DATA_SETS_IN_JSON, $jsonReader);
    }

    /**
     * @return void
     */
    public function testDataReaderCanReadJsonFilesWithoutEnvelope(): void
    {
        $jsonReader = $this->getJsonReader(Configuration::dataDir() . 'import-no-envelope.json', false);
        $this->tester->assertDataSetCount(static::EXPECTED_NUMBER_OF_DATA_SETS_IN_JSON, $jsonReader);
    }

    /**
     * @return void
     */
    public function testDataReaderCanBeConfiguredToUseNewFileAfterInstantiation(): void
    {
        $jsonReader = $this->getJsonReader(Configuration::dataDir() . 'import-empty.json');
        $dataImportReaderConfigurationTransfer = new DataImporterReaderConfigurationTransfer();
        $dataImportReaderConfigurationTransfer
            ->setFileName(Configuration::dataDir() . 'import-standard.json');

        $jsonReader->configure($dataImportReaderConfigurationTransfer);
        $currentRow = $jsonReader->current();

        $this->tester->assertDataSetWithKeys(1, $currentRow);
    }

    /**
     * @return void
     */
    public function testDataReaderCanBeConfiguredToUseNewFileAndEnvelopeAfterInstantiation(): void
    {
        $jsonReader = $this->getJsonReader(Configuration::dataDir() . 'import-empty.json');
        $dataImportReaderConfigurationTransfer = new DataImporterReaderConfigurationTransfer();
        $dataImportReaderConfigurationTransfer
            ->setFileName(Configuration::dataDir() . 'import-items-envelope.json')
            ->setJsonEnvelope('items')
            ->setCsvHasHeader(CsvReaderConfiguration::DEFAULT_HAS_HEADER);

        $jsonReader->configure($dataImportReaderConfigurationTransfer);
        $currentRow = $jsonReader->current();

        $this->tester->assertDataSetWithKeys(1, $currentRow);
    }

    /**
     * @return void
     */
    public function testDataReaderReturnSubsetOfTheDataSetsStartingAtGivenPositionWhenOffsetIsSet(): void
    {
        $jsonReader = $this->getJsonReader(Configuration::dataDir() . 'import-standard.json', true, 'data', 2);

        $jsonReader->rewind();

        $this->tester->assertDataSetWithKeys(2, $jsonReader->current());
        $jsonReader->next();
        $this->assertTrue($jsonReader->valid(), 'Expected that DataReaderInterface::valid() returns true because no limit was set and after received data set there is still one.');
    }

    /**
     * @return void
     */
    public function testDataReaderReturnSubsetOfTheDataSetsWhenOffsetAndLimitIsSet(): void
    {
        $jsonReader = $this->getJsonReader(Configuration::dataDir() . 'import-standard.json', true, 'data', 2, 1);

        $jsonReader->rewind();

        $this->tester->assertDataSetWithKeys(2, $jsonReader->current());
        $jsonReader->next();
        $this->assertFalse($jsonReader->valid(), 'Expected that DataReaderInterface::valid() returns false because we limited the data set to one.');
    }

    /**
     * @return void
     */
    public function testDataReaderReturnSubsetOfTheDataSetsWhenLimitIsSet(): void
    {
        $jsonReader = $this->getJsonReader(Configuration::dataDir() . 'import-standard.json', true, 'data', null, 1);

        $jsonReader->rewind();

        $this->tester->assertDataSetWithKeys(1, $jsonReader->current());
        $jsonReader->next();
        $this->assertFalse($jsonReader->valid(), 'Expected that DataReaderInterface::valid() returns false because we limited the data set to one.');
    }

    /**
     * @return void
     */
    public function testEachDataSetShouldHaveJsonColumnNamesAsKeys(): void
    {
        $jsonReader = $this->getJsonReader(Configuration::dataDir() . 'import-standard.json');

        $firstRow = $jsonReader->current();
        $this->tester->assertDataSetWithKeys(1, $firstRow);
        $jsonReader->next();

        $secondRow = $jsonReader->current();
        $this->tester->assertDataSetWithKeys(2, $secondRow);
        $jsonReader->next();

        $thirdRow = $jsonReader->current();
        $this->tester->assertDataSetWithKeys(3, $thirdRow);
    }

    /**
     * @return void
     */
    public function testKeyReturnsCurrentDataSetPosition(): void
    {
        $jsonReader = $this->getJsonReader(Configuration::dataDir() . 'import-standard.json');
        $this->assertIsInt($jsonReader->key());
    }

    /**
     * @return void
     */
    public function testThrowsExceptionWhenFileInvalid(): void
    {
        $this->expectException(DataReaderException::class);
        $configuration = $this->getJsonReaderConfigurationTransfer(Configuration::dataDir() . 'not-existing.json');

        $this->tester->getFactory()->createJsonReaderFromConfig($configuration);
    }

    /**
     * @param string $fileName
     * @param bool $hasEnvelope
     * @param string $envelope
     * @param int|null $offset
     * @param int|null $limit
     *
     * @return \Spryker\Zed\DataImport\Business\Model\DataReader\DataReaderInterface|\Spryker\Zed\DataImport\Business\Model\DataReader\ConfigurableDataReaderInterface|\Countable
     */
    protected function getJsonReader(
        string $fileName,
        bool $hasEnvelope = true,
        string $envelope = 'data',
        ?int $offset = null,
        ?int $limit = null
    ) {
        $configuration = $this->getJsonReaderConfigurationTransfer($fileName, $hasEnvelope, $envelope, $offset, $limit);
        $jsonReader = $this->tester->getFactory()->createJsonReaderFromConfig($configuration);

        return $jsonReader;
    }

    /**
     * @param string $fileName
     * @param bool $hasEnvelope
     * @param string $envelope
     * @param int|null $offset
     * @param int|null $limit
     *
     * @return \Generated\Shared\Transfer\DataImporterReaderConfigurationTransfer
     */
    protected function getJsonReaderConfigurationTransfer(
        string $fileName,
        bool $hasEnvelope = true,
        string $envelope = 'data',
        ?int $offset = null,
        ?int $limit = null
    ): DataImporterReaderConfigurationTransfer {
        $dataImporterReaderConfiguration = new DataImporterReaderConfigurationTransfer();
        $dataImporterReaderConfiguration
            ->setFileName($fileName)
            ->setJsonHasEnvelope($hasEnvelope)
            ->setJsonEnvelope($envelope)
            ->setOffset($offset)
            ->setLimit($limit);

        return $dataImporterReaderConfiguration;
    }
}
