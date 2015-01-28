<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\blogs\models;

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
class BlogModel extends AbstractModel implements FormBuilderInterface{
    
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Blog';
        $this->tablename = 'blogs';
    }
    
    public function search() {
        $params = array('keywords' => $this->httpRequest->getPost());
       
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'search', $params['keywords']); 
      
        return $this->formatResults($data['Claims']);
    }
    
    
    public function get($id) {
        $locale = $this->getDefaultLocale();
        
        $params = array(
            'id' => intval($id),
            'locale' => $locale['locale'],
            'isActive' => '1',
            'isPublished' => '1',
            'isPublic' => '1'
        );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params); 
        
        return $data;
    }
    
    public function listByDate($year, $month) {
      
        $params = array('onCallDate' => $year . $month);       
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'listByDate', $params); 
        
        return array('OnCallInstances' => $this->formatDateResults($data['OnCallInstances']));
    }
    
    private function formatDateResults(array $list) {
        $retval = array();
        foreach($list as $row) {
           
            $date = substr($row['onCallDate'], 0, 10);
            $retval[$date][] = $row;
        }
        
        return $retval;
    }
    
    public function save($id) {
        
        $params = $this->httpRequest->getPost();
        $params[$this->entity]['id'] = intval($id);
        $params[$this->entity]['Author_id'] = $this->getLoggedInStaffId();
        
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);
        //pr($params);
        return $data;
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
