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
use Monolog\Logger;
use core\datasources\ConnectionAdapter;
use core\datasources\DataSourceInterface;
use core\datasources\RestDataSource;

/**
 * Description of RestConnectionAdapter
 *
 * @author Dave Meikle
 */
class RestConnectionAdapter extends ConnectionAdapter {
    
    public function __construct(Logger $logger) {
        parent::__construct($logger, new RestDataSource($logger));
        
    }    
    
    public function query($queryType, AbstractModel $entity = null, $verb = null, $params = array()) {
        $this->datasource->setDatasourceKey($this->keyname);
        return $this->datasource->query($queryType, $entity, $verb, $params);
    }


}
