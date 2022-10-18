<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\DataImportsRestApi;

use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @method \Pyz\Glue\DataImportsRestApi\DataImportsRestApiConfig getConfig()
 */
class DataImportsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_DATA_IMPORT = 'CLIENT_DATA_IMPORT';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = $this->addDataImportClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addDataImportClient(Container $container): Container
    {
        $container->set(static::CLIENT_DATA_IMPORT, function (Container $container) {
            return $container->getLocator()->dataImport()->client();
        });

        return $container;
    }
}
