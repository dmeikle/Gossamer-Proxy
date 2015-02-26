<?php

namespace core\datasources;


use core\AbstractModel;


interface DataSourceInterface
{
    public function query($queryType, AbstractModel $entity, $verb, $params);
    
    public function setDatasourceKey($keyName);
    
}
