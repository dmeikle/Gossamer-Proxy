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

use core\datasources\ConnectionAdapter;

/**
 * Description of DatasourceAware
 *
 * @author Dave Meikle
 */
class DatasourceAware {
    
    protected $datasource = null;
    
    public function setDatasource(ConnectionAdapter $datasource) {
        $this->datasource = $datasource;
    }
}
