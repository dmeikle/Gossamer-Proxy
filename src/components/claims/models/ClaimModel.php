<?php

namespace components\claims\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

/**
 * Description of PropertyModel
 *
 * @author davem
 */
class ClaimModel extends AbstractModel implements FormBuilderInterface{
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Claim';
        $this->tablename = 'claims';
    }
    
    public function search() {
        $params = array('keywords' => $this->httpRequest->getPost());
       
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params['keywords']); 
      
        return $this->formatResults($data['Claims']);
    }
    
    private function formatResults(array $results) {
        $retval = array();
        
        foreach($results as $row) {
            $retval[] = array(
                'id' => $row['id'],
                'label' => $row['buildingName'] . "," . $row['address1'] . ", " . $row['address2'].", " .
                $row['city'],
                'value' => '<b>' .$row['buildingName'] . "</b><br />" . $row['address1'] . "<br />" . 
                ((strlen($row['address2']) > 0)? $row['address2'] . '<br />' :'') .
                $row['city']
                );
        }
        
        return $retval;
    }
    
    public function get($id) {
       
        return array();
    }
    
    public function save($id) {
        
        $params = $this->httpRequest->getPost();        
        //$params['id'] = intval($id);        
     
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);
        
        return $data;
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
