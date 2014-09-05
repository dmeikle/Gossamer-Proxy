<?php


namespace core\datasources;

use Monolog\Logger;
use core\AbstractModel;
use core\datasources\ConnectionAdapter;

/**
 * Description of SQLConnectionAdapter
 *
 * @author Dave Meikle
 */
class DBConnectionAdapter extends ConnectionAdapter
{
    public function __construct(Logger $logger) {
        parent::__construct($logger, new DBConnection());
    }
    
    public function query($queryType, AbstractModel $entity = null, $verb = null, $params = array()) {
        $this->datasource->query($queryType);
    }

}
