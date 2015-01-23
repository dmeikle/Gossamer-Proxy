<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\shoppingcart\models;


use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

class ItemModel extends AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'CartItem';
    }
    
    
    public function listAll($categoryId, $offset, $limit) {
        $params = (($categoryId > 0)? array('categoryId' => $categoryId ) : array());
        $params[self::DIRECTIVES] = array('offset' => $offset, 'limit' => $limit);
        
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
    
        $this->render($data);
    }
    
    public function get($itemId) {
        $params = array('itemId' => $itemId );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
    
        $this->render($data);
    }
    
    public function save() {
        $params = $this->httpRequest->getPost();
        
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);
        
        $this->render($data);
    }
    
    public function delete($itemId) {
        $params = $this->httpRequest->getPost();
        
        $data = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $params);
        
        $this->render($data);
    }
}
