<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace components\accounting\listeners;

use core\eventlisteners\AbstractCachableListener;
use components\accounting\models\AccountingGeneralCostItemModel;

/**
 * SaveTollListener
 *
 * @author Dave Meikle
 */
class LoadTollListener extends \core\eventlisteners\AbstractCachableListener {
    
    public function on_filerender_start() {
        
        $model = new AccountingGeneralCostItemModel($this->httpRequest, $this->httpResponse, $this->logger);
 
        $datasource = $this->getDatasource('components\accounting\models\AccountingGeneralCostItemModel');
        $params= array('AccountsPayableItemTypes_id' => '1');
        
        $result = $datasource->query('get', $model, 'list', $params);
        $retval = '';
        
        foreach($result['AccountingGeneralCostItems'] as $row) {
            $retval .= '<option value="' . $row['cost'] . '">' . $row['abbreviation'] . "<option>\r\n";
        }
        
        $this->saveValuesToCache($this->getKey(), $retval);
    }
    
    
}