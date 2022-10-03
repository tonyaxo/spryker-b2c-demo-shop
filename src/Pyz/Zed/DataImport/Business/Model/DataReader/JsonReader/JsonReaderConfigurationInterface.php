<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\DataReader\JsonReader;

use Generated\Shared\Transfer\DataImporterReaderConfigurationTransfer;

interface JsonReaderConfigurationInterface
{
    /**
     * @param \Generated\Shared\Transfer\DataImporterReaderConfigurationTransfer $dataImporterReaderConfigurationTransfer
     *
     * @return $this
     */
    public function setDataImporterReaderConfigurationTransfer(DataImporterReaderConfigurationTransfer $dataImporterReaderConfigurationTransfer);

    /**
     * @return string
     */
    public function getFileName();

    /**
     * @return bool
     */
    public function hasEnvelope();

    /**
     * @return string
     */
    public function getEnvelopeName();

    /**
     * @return int|null
     */
    public function getOffset();

    /**
     * @return int|null
     */
    public function getLimit();
}
