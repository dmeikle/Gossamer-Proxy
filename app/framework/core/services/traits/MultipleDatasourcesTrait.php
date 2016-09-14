<?php
/**
 * Created by PhpStorm.
 * User: dave
 * Date: 9/12/2016
 * Time: 2:02 PM
 */

namespace core\services\traits;


use core\datasources\DatasourceFactory;

trait MultipleDatasourcesTrait
{
    private $datasourceFactory = null;

    public function setDatasourceFactory(DatasourceFactory $factory) {
        $this->datasourceFactory = $factory;
    }
}