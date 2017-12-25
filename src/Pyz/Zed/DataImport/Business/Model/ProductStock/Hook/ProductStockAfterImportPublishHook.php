<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\DataImport\Business\Model\ProductStock\Hook;

use Orm\Zed\Availability\Persistence\Map\SpyAvailabilityAbstractTableMap;
use Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Pyz\Zed\DataImport\Business\Model\DataImporterPublisher;
use Spryker\Zed\Availability\Dependency\AvailabilityEvents;
use Spryker\Zed\DataImport\Business\Model\DataImporterAfterImportInterface;

class ProductStockAfterImportPublishHook implements DataImporterAfterImportInterface
{
    /**
     * @var array
     */
    protected $entityEvents = [];

    /**
     * @return void
     */
    public function afterImport()
    {
        $availabilities = SpyAvailabilityAbstractQuery::create()
            ->addJoin(
                SpyAvailabilityAbstractTableMap::COL_ABSTRACT_SKU,
                SpyProductAbstractTableMap::COL_SKU,
                Criteria::INNER_JOIN
            )
            ->withColumn(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, 'idProductAbstract')
            ->find()
        ;

        foreach ($availabilities as $availability) {
            $this->entityEvents[AvailabilityEvents::AVAILABILITY_ABSTRACT_PUBLISH][] = $availability->getIdProductAbstract();
        }

        DataImporterPublisher::addImportedEntityEvents($this->entityEvents);
    }
}
