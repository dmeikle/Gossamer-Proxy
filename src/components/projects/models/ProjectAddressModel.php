<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\projects\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;


/**
 * Description of PropertyModel
 *
 * @author Dave Meikle
 */
class ProjectAddressModel extends AbstractModel implements FormBuilderInterface{
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'ProjectAddress';
        $this->tablename = 'projectaddresses';
    }
//    
//    public function search(array $term) {
//        $params = array('keywords' => $this->httpRequest->getPost());
//       
//        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params['keywords']); 
//      
//        return $this->formatResults($data['ProjectAddresses']);
//    }
    
    public function search(array $term) {
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $term);
        
        return $data;       
    }
    
    public function save($id) {
        $params = $this->httpRequest->getPost();
        
        $params['ProjectAddress']['id'] = intval($id);

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['ProjectAddress']); 
        
        return $data;
    }
    
    public function listall($offset = 0, $rows = 20, $customVerb = null, array $params = null) {
        $result = parent::listall($offset, $rows, 'listAddresses');
        
        return $result;
    }
    
    private function formatResults(array $results) {
        $retval = array();
        
        foreach($results as $row) {
            $retval[] = array(
                'id' => $row['id'],
                'label' => $row['strataNumber'] . ' - ' . $row['buildingName'] . "," . $row['address1'] . ", " . $row['city'],
                //'value' => json_encode(array('strataNumber' => $row['strataNumber'], 'buildingName' => $row['buildingName'], 'address1' => $row['address1'], 'city' => $row['city']))
                'value' => $row['strataNumber'],
                'buildingName' => $row['buildingName'],
                'address1' => $row['address1'], 
                'city' => $row['city']
                );
        }
        
        return $retval;
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
