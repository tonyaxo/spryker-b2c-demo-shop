<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImportsRestApi;

use Pyz\Zed\DataImportsRestApi\Dependency\Facade\DataImportsRestApiToDataImportFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \Pyz\Zed\DataImportsRestApi\DataImportsRestApiConfig getConfig()
 */
class DataImportsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_DATA_IMPORT = 'FACADE_DATA_IMPORT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addDataImportFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addDataImportFacade(Container $container): Container
    {
        $container->set(static::FACADE_DATA_IMPORT, function (Container $container) {
            return new DataImportsRestApiToDataImportFacadeBridge($container->getLocator()->dataImport()->facade());
        });

        return $container;
    }
}
