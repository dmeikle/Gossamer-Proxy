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
class AccountingGeneralCostItemModel extends AbstractModel{
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'AccountingGeneralCostItem';
        $this->tablename = 'accountinggeneralcostitems';
    }
    
    public function listall($offset = 0, $rows = 20, $customVerb = NULL)  {
        $queryParams = $this->httpRequest->getQueryParameters();
        
        $params = array(
            //'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit, 'directive::ORDER_BY' => 'Products.id asc'
            'directive::OFFSET' => intval($offset), 'directive::LIMIT' => intval($rows)
        );
        
        foreach($queryParams as $key => $value) {
            //$params['directive::' . strtoupper($key)] = $value; //commented out to fix advanced search
            $params[$key] = $value;
        }
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
        
        return $data;
    }
}
