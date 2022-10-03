<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\DataImport;

use Pyz\Client\DataImport\Zed\DataImportStub;
use Spryker\Client\Kernel\AbstractFactory;

class DataImportFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Client\DataImport\Zed\DataImportStubInterface
     */
    public function createZedStub()
    {
        return new DataImportStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient()
    {
        return $this->getProvidedDependency(DataImportDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
