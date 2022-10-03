<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\CombinedProduct\ProductExample;

use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ExampleDataSetNormalizerStep implements DataImportStepInterface
{
    public const COLUMN_PRODUCT_PRICE_VALUE_NET = 'product_price.value_net';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $this->normalizePrices($dataSet);
    }

    /**
     * @return void
     */
    protected function normalizePrices(DataSetInterface $dataSet): void
    {
        $dataSet[static::COLUMN_PRODUCT_PRICE_VALUE_NET] = preg_replace('/[^0-9]/', '', $dataSet[static::COLUMN_PRODUCT_PRICE_VALUE_NET]);
    }
}
