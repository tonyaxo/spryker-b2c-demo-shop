<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImportsRestApi;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class DataImportsRestApiConfig extends AbstractBundleConfig
{
    protected const IMPORT_TYPE_DEFAULT = 'combined-product-abstract-example';

    /**
     * @return string|null
     */
    public function getDefaultDataImportCsvPath(): ?string
    {
        return APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR . 'data/import/api/data_import.csv';
    }

    /**
     * @return string|null
     */
    public function getDefaultImportType(): ?string
    {
        return static::IMPORT_TYPE_DEFAULT;
    }
}
