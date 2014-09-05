<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
