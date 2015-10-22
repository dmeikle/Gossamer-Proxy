<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\accounting\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * Description of PurchaseOrderModel
 *
 * @author Dave Meikle
 */
class SuppliesUsedModel extends AbstractModel{
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'SuppliesUsed';
        $this->tablename = 'accountingsuppliesused';
    }
    
    
    
    public function search(array $params) {
        $locale= $this->getDefaultLocale();
        $params['isActive'] = '1';
        $params['locale'] = $locale['locale'];
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params); 
      
        return $data;
    }
    
}
