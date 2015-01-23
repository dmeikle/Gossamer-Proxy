<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace libraries\service;

use database\DBConnection;
use core\Config;
use libraries\service\ConfigManager;
use exceptions\TableNotFoundException;


/**
 * Column Mappings Class - gets entity columns from table and serializes array
 *
 * Author: Dave Meikle
 * Copyright: Quantum Unit Solutions 2013
 */
class ColumnMappings
{
    /**
     * list of tables mapped and loaded
     */
    private $tableList = array();

    /**
     * DBConnection
     */
    private $dbConnection = null;


    /**
     * constructor
     *
     * @param DBConnection  connection
     */
    public function __construct(DBConnection $dbConnection){
        if(!$dbConnection instanceof DBConnection){
            //throw new \RuntimeException('Database Connection must be instance of DBConnection');
        }

        $this->dbConnection = $dbConnection;
    }

    /**
     * getTableColumnList
     *
     * @param string    $tableName
     *
     * @return array    list of columns
     */
    public function getTableColumnList($tableName){

        if(!array_key_exists($tableName, $this->tableList)){

            $this->addColumnMap($tableName, $this->getColumnMappingsFromConfig($tableName));
        }

        return $this->tableList[$tableName];
    }

    /**
     * addColumnMap - adds an array of columns to a the tableList
     *
     * @param string    tableName
     * @param array     list of columns
     */
    private function addColumnMap($tableName, $columns = array()){

        $this->tableList[$tableName] = $columns;
    }

    /**
     * getColumnMappingsFromConfig retrieves serialized column list specific to a table
     *
     * @param string    tablename
     *
     * @return array    list of columns
     *
     */
    private function getColumnMappingsFromConfig($tableName){
 error_log($filename = __SITE_PATH . "/../" .  'mappings' . DIRECTORY_SEPARATOR . "$tableName.conf");
        //$filename = realpath('/tmp/'.__SITE_NAME .'/config') . DIRECTORY_SEPARATOR . "$tableName.conf";
		$filename = __SITE_PATH . "/../" .  'mappings' . DIRECTORY_SEPARATOR . "$tableName.conf";
        
        $configManager = new ConfigManager();
		$config = $configManager->getConfiguration($filename);

        if(is_null($config)){
            $result = $this->dbConnection->query('SHOW COLUMNS FROM ' . $tableName);
            
            if(is_null($result)) {
                error_log("ColumnMappings: $tableName does not exist");
                throw new TableNotFoundException('table not found');
            }
            $columnNames = array();

            foreach($result as $object => $values){
                    foreach($values as $column => $val){
                            if($column == 'Field' && !in_array($val, $columnNames)){
                                    array_push($columnNames, $val);
                            }
                    }
            }

           $config = new Config($columnNames);

           $configManager->saveConfiguration($filename, $config);
        }

        return $config->toArray();

    }

}
