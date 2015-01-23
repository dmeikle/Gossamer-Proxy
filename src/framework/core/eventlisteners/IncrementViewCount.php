<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\eventlisteners;

use core\http\HTTPRequest;
use database\DBConnection;


class IncrementViewCount  extends AbstractListener
{
    private $registry = null;

    private $tableName = null;

    public function on_request_end($params) {
        

        $this->tableName = $item->getEntity()->getTableName();

         // looks for an observer method with the state name
        if (method_exists($this, $item->getState())) {
            call_user_func_array(array($this, $item->getState()), array($item->getResult()));
        }
    }

    private function viewSuccess($result) {
        $db = new DBConnection();

        $query = 'update ' . $this->tableName . ' set numViews = numViews +1 where id = ' . $result['id'];
        $db->query($query);

        unset($db);
    }
}
