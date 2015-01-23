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

class TaxModel extends AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Tax';
        $this->tablename = 'taxrates';
    }
    
    
    public function listall($offset = 0, $rows = 20, $customVerb = NULL) {
        
        $params = array(
            //'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit, 'directive::ORDER_BY' => 'Products.id asc'
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows
        );
        $defaultLocale =  $this->getDefaultLocale();
        $params['locale'] = $defaultLocale['locale'];
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
        $taxRates = current($data['TaxRates']);
       
        $rates = array();
        foreach($taxRates as $taxRate) {
            $rates[$taxRate['States_id']] = $taxRate['taxRate'];
        }
        $data['TaxRates'] = $rates;
        if(array_key_exists(ucfirst($this->tablename) . 'Count', $data)) {
            $data['pagination'] = $this->getPagination($data[ucfirst($this->tablename) . 'Count'], $offset, $rows);
        }
        
        $data['stateList'] = $this->httpRequest->getAttribute('stateList');
        $this->render($data);
    
    }
    
    
    public function save($id) {
      
        $params = $this->httpRequest->getPost();
        $submitValues = array();
        pr($params);
        foreach($params['taxes'] as $key => $row) {
            $submitValues[] = array('States_id' => $key, 'taxRate' => $row);
        }
        pr($submitValues);
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $submitValues); 
       
      
    }
    
    public function delete($itemId) {
        $params = $this->httpRequest->getPost();
        
        $data = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, $params);
        
        $this->render($data);
    }
}
