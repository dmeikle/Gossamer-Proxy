<?php



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
