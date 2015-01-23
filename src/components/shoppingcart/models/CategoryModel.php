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


class CategoryModel extends  AbstractModel
{
    
    const DIRECTIVES = 'directives';
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Category';
        $this->tablename = 'categories';
        
    }
    
    public function listAll($offset = 0, $limit = 20) {
        $params = array();
        $params[self::DIRECTIVES] = array('offset' => $offset, 'limit' => $limit);
        
        $defaultLocale =  $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
    
        $this->render($data);
    }

    public function edit($id) {
        //pre-loaded from eventhandler
        $categories = $this->httpRequest->getAttribute('categoryList');

        $params = array('id' => $id );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        $data['categories'] = $categories;
        $data['thumbnails'] = $this->getFileList(__SITE_PATH . "/images/categories/");
        $this->render($data);
    }
    
    public function listAllByParentId($parentId, $offset, $limit) {
        $params = (($parentId > 0)? array('parentId' => $parentId ) : array());
        $params[self::DIRECTIVES] = array('offset' => $offset, 'limit' => $limit);
        
        $defaultLocale =  $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
    
        $this->render($data);
    }
    
    public function get($categoryId) {
        echo "deprecating get to use edit. id is $categoryId";
        die;
        $params = array('id' => $categoryId );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
    
        $this->render($data);
    }
    
    public function save($id) {
        
        $params = $this->httpRequest->getPost();
        $params['category']['id'] = $id;
       
      
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['category']);
      
       // $this->render($data);
    }
    
    public function delete($categoryId) {
        $params = $this->httpRequest->getPost();
        
        $data = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $params);
        
        $this->render($data);
    }
}
