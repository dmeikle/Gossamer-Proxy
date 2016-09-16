<?php
/**
 * Created by PhpStorm.
 * User: dave
 * Date: 9/9/2016
 * Time: 3:54 PM
 */

namespace core\datasources;


use core\datasources\MSDBConnection;
use Monolog\Logger;
use core\AbstractModel;

class MSSQLConnectionAdapter extends ConnectionAdapter implements DataSourceInterface
{

    public function __construct(Logger $logger = null, MSDBConnection $conn = null, array $credentials = null) {
        if(is_null($conn)) {
            parent::__construct($logger, new MSDBConnection($credentials));
        } else {
            parent::__construct($logger, $conn);
        }
    }

    public function query($queryType, AbstractModel $entity = null, $verb = null, $params = array()) {

        return $this->datasource->query($queryType);
    }

    public function execute($query) {
        return $this->datasource->query($query);
    }
}