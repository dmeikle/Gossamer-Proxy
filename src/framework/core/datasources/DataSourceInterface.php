<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\datasources;

use core\AbstractModel;

/**
 * DataSourceInterface
 */
interface DataSourceInterface {

    public function query($queryType, AbstractModel $entity, $verb, $params);

    public function setDatasourceKey($keyName);
}
