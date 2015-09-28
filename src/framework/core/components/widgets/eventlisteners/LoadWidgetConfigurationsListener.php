<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace core\components\widgets\eventlisteners;

use core\eventlisteners\AbstractCachableListener;
use core\components\widgets\models\SystemWidget;

/**
 * LoadSystemWidgetsListener
 *
 * @author Dave Meikle
 */
class LoadSystemWidgetsListener extends AbstractCachableListener{
    
    public function on_request_start($param) {
        $systemWidget = new SystemWidget($this->httpRequest, $this->httpResponse, $this->logger);
      
        $params = array('ymlKey'=> __YML_KEY);
        
        $datasource = $this->getDatasource($systemWidget);
  
        $results = $datasource->query('get', $systemWidget, 'list', $params);
        if(is_array($results) && array_key_exists('WidgetsSystems', $results)) {
            $this->httpRequest->setAttribute('SystemWidgets', $results['WidgetsSystems']);
        }
        echo "here is results";
        pr($results);
    }
}
