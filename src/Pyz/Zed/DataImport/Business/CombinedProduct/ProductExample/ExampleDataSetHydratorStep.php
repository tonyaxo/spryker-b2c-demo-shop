<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\CombinedProduct\ProductExample;

use Pyz\Zed\DataImport\Business\CombinedProduct\ProductAbstract\CombinedProductAbstractHydratorStep;
use Pyz\Zed\DataImport\Business\CombinedProduct\ProductPrice\CombinedProductPriceHydratorStep;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ExampleDataSetHydratorStep implements DataImportStepInterface
{
    public const COLUMN_ABSTRACT_SKU = 'abstract_sku';
    public const COLUMN_CONCRETE_SKU = 'concrete_sku';
    public const COLUMN_PRODUCT_NAME = 'product.name.{LOCALE}';
    public const COLUMN_PRODUCT_PRICE_VALUE_NET = 'product_price.value_net';

    public const COLUMN_EXAMPLE_ID = 'Id';
    public const COLUMN_EXAMPLE_PRODUCT_NAME = 'product_name';
    public const COLUMN_EXAMPLE_PART_NUMBER = 'part_number';
    public const COLUMN_EXAMPLE_PRIZE = 'prize';

    public const COLUMN_MAP = [
        self::COLUMN_EXAMPLE_ID => self::COLUMN_ABSTRACT_SKU,
        self::COLUMN_EXAMPLE_PRODUCT_NAME => self::COLUMN_PRODUCT_NAME,
        self::COLUMN_EXAMPLE_PART_NUMBER => self::COLUMN_CONCRETE_SKU,
        self::COLUMN_EXAMPLE_PRIZE => self::COLUMN_PRODUCT_PRICE_VALUE_NET,
    ];

    protected const ASSIGNED_TYPE_ABSTRACT = 'abstract';
    protected const ASSIGNED_TYPE_CONCRETE = 'concrete';
    protected const ASSIGNED_TYPE_BOTH = 'both';

    protected const DEFAULT_PRICE_TYPE = 'DEFAULT';

    protected const DEFAULT_PRODUCT_CATEGORY = 'demoshop';

    protected Store $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $this->mapExampleColumnsToCombinedDataSet($dataSet);
        $this->addAssignedProductType($dataSet);
        $this->addCategoryKey($dataSet);
        $this->addProductPriceStore($dataSet);
        $this->addProductPriceCurrency($dataSet);
        $this->addProductPriceType($dataSet);
    }

    /**
     * @return void
     */
    protected function mapExampleColumnsToCombinedDataSet(DataSetInterface $dataSet): void
    {
        foreach (static::COLUMN_MAP as $srcColumn => $destColumn) {
            $dataSet[$destColumn] = $dataSet[$srcColumn];
        }
    }

    /**
     * @return void
     */
    protected function addAssignedProductType(DataSetInterface $dataSet): void
    {
        $dataSet[CombinedProductAbstractHydratorStep::COLUMN_ASSIGNED_PRODUCT_TYPE] = static::ASSIGNED_TYPE_BOTH;
        $dataSet[CombinedProductPriceHydratorStep::COLUMN_ASSIGNED_PRODUCT_TYPE] = static::ASSIGNED_TYPE_CONCRETE;
    }

    /**
     * @return void
     */
    protected function addProductPriceType(DataSetInterface $dataSet): void
    {
        $dataSet[CombinedProductPriceHydratorStep::COLUMN_PRICE_TYPE] = static::DEFAULT_PRICE_TYPE;
    }

    /**
     * @return void
     */
    protected function addProductPriceStore(DataSetInterface $dataSet): void
    {
        $dataSet[CombinedProductPriceHydratorStep::COLUMN_STORE] = $this->store->getStoreName();
    }

    /**
     * @return void
     */
    protected function addProductPriceCurrency(DataSetInterface $dataSet): void
    {
        $dataSet[CombinedProductPriceHydratorStep::COLUMN_CURRENCY] = $this->store->getDefaultCurrencyCode();
    }

    /**
     * @return void
     */
    protected function addCategoryKey(DataSetInterface $dataSet): void
    {
        $dataSet[CombinedProductAbstractHydratorStep::COLUMN_CATEGORY_KEY] = static::DEFAULT_PRODUCT_CATEGORY;
    }
}
