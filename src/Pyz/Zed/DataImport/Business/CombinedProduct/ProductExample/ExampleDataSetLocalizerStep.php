<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\CombinedProduct\ProductExample;

use Spryker\Shared\Kernel\Store;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ExampleDataSetLocalizerStep implements DataImportStepInterface
{
    protected const PRODUCT_ABSTRACT_URL = 'product_abstract.url';

    protected const LOCALIZED_COLUMNS = [
        'product_abstract.meta_title.{LOCALE}',
        'product_abstract.meta_description.{LOCALE}',
        'product_abstract.meta_keywords.{LOCALE}',
        'product_abstract.url.{LOCALE}',
        'product_concrete.is_searchable.{LOCALE}',
        'product.name.{LOCALE}',
        'product.description.{LOCALE}',
    ];

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
        $this->addColumnsLocale($dataSet);
        $this->createLocalizedProductUrls($dataSet);
    }

    /**
     * @return void
     */
    protected function addColumnsLocale(DataSetInterface $dataSet): void
    {
        foreach (static::LOCALIZED_COLUMNS as $columnName) {
            foreach ($this->store->getLocales() as $locale) {
                $localizedColumnName = str_replace('{LOCALE}', $locale, $columnName);
                $dataSet[$localizedColumnName] = $dataSet[$columnName];
            }

            unset($dataSet[$columnName]);
        }
    }

    /**
     * @return void
     */
    protected function createLocalizedProductUrls(DataSetInterface $dataSet): void
    {
        foreach ($this->store->getLocales() as $locale) {
            $localizedProductUrlColumn = static::PRODUCT_ABSTRACT_URL . '.' . $locale;
            $dataSet[$localizedProductUrlColumn] = '/' . $locale . '/' . $dataSet[ExampleDataSetHydratorStep::COLUMN_EXAMPLE_ID];
        }
    }
}
