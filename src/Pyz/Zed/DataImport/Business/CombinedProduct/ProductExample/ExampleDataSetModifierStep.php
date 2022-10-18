<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\CombinedProduct\ProductExample;

use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ExampleDataSetModifierStep implements DataImportStepInterface
{
    protected const DATA_SET = [
        'abstract_sku' => '',
        'concrete_sku' => '',
        'product_abstract_store.store_name' => '',
        'product_abstract.category_key' => '',
        'product_abstract.category_product_order' => '',
        'product_abstract.is_featured' => '',
        'product_abstract.color_code' => '',
        'product_abstract.tax_set_name' => '',
        'product_abstract.new_from' => '',
        'product_abstract.new_to' => '',
        'product_abstract.meta_title.{LOCALE}' => '',
        'product_abstract.meta_description.{LOCALE}' => '',
        'product_abstract.meta_keywords.{LOCALE}' => '',
        'product_abstract.url.{LOCALE}' => '',
        'product_concrete.old_sku' => '',
        'product_concrete.bundled' => '',
        'product_concrete.is_quantity_splittable' => '',
        'product_concrete.is_searchable.{LOCALE}' => '',
        'product.assigned_product_type' => '',
        'product.icecat_pdp_url' => '',
        'product.icecat_license' => '',
        'product.name.{LOCALE}' => '',
        'product.description.{LOCALE}' => '',
        'product_stock.name' => '',
        'product_stock.quantity' => '',
        'product_stock.is_never_out_of_stock' => '',
        'product_stock.is_bundle' => '',
        'product_group.group_key' => '',
        'product_group.position' => '',
        'product_price.assigned_product_type' => '',
        'product_price.price_type' => '',
        'product_price.store' => '',
        'product_price.currency' => '',
        'product_price.value_net' => '',
        'product_price.value_gross' => '',
        'product_price.price_data.volume_prices' => '',
        'product_image.assigned_product_type' => '',
        'product_image.image_set_name' => '',
        'product_image.external_url_large' => '',
        'product_image.external_url_small' => '',
        'product_image.locale' => '',
        'product_image.sort_order' => '',
        'product_image.product_image_key' => '',
        'product_image.product_image_set_key' => '',
    ];

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $this->addDefaultCombinedData($dataSet);
    }

    /**
     * @return void
     */
    protected function addDefaultCombinedData(DataSetInterface $dataSet): void
    {
        foreach (static::DATA_SET as $columnKey => $value) {
            $dataSet[$columnKey] = $value;
        }
    }
}
