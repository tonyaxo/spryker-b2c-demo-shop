<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\CombinedProduct\ProductExample;

use Pyz\Zed\DataImport\Business\CombinedProduct\DataSet\CombinedProductMandatoryColumnCondition;

class CombinedProductExampleMandatoryColumnCondition extends CombinedProductMandatoryColumnCondition
{
    /**
     * @return string[]
     */
    protected function getMandatoryColumns(): array
    {
        return [
            ExampleDataSetHydratorStep::COLUMN_EXAMPLE_ID,
            ExampleDataSetHydratorStep::COLUMN_EXAMPLE_PRODUCT_NAME,
            ExampleDataSetHydratorStep::COLUMN_EXAMPLE_PART_NUMBER,
            ExampleDataSetHydratorStep::COLUMN_EXAMPLE_PRIZE,
        ];
    }
}
