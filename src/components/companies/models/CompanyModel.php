<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\companies\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * Description of CompanyModel
 *
 * @author Dave Meikle
 */
class CompanyModel extends AbstractModel{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Company';
        $this->tablename = 'companies';        
    }
    
    public function search(array $term) {
        $params = array('keywords' => $this->httpRequest->getPost());
       
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params['keywords']); 
      
        return $this->formatResults($data['Companies']);
    }
    
    private function formatResults(array $results) {
        $retval = array();
        foreach($results as $row) {
            $retval[] = array(
                'id' => $row['id'],
                'label' => $row['name'] . "," . $row['address1'] . ", " . $row['address2'].", " .
                $row['city'],
                'value' => '<b>' .$row['name'] . "</b><br />" . $row['address1'] . "<br />" . 
                ((strlen($row['address2']) > 0)? $row['address2'] . '<br />' :'') .
                $row['city']
                );
        }
        
        return $retval;
    }
    
    public function searchResults() {
        return array();
    }
}
