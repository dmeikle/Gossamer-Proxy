<?php


namespace core\datasources;

use Monolog\Logger;
use core\AbstractModel;
use core\datasources\ConnectionAdapter;
use core\datasources\DataSourceInterface;

/**
 * Description of SQLConnectionAdapter
 *
 * @author Dave Meikle
 */
class DBConnectionAdapter extends ConnectionAdapter implements DataSourceInterface
{
    
    public function __construct(Logger $logger) {
        parent::__construct($logger, new DBConnection());
    }    
    
    public function query($queryType, AbstractModel $entity = null, $verb = null, $params = array()) {
        
       return $this->datasource->query($queryType);
    }

    public function execute($query) {
         return $this->datasource->query($query);
    }
}
