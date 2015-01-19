<?php

namespace core\components\cms\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * Description of PageModel
 *
 * @author Dave Meikle
 */ 
class PageModel extends AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'CmsPage';
        $this->tablename = 'cmspages';        
    }
    
    public function getArray($id) {
        return array(
                array('id' => intval($id), 
                    'CmsCategories_id' => '0',
                    'name' => '',
                    'summary' => '',
                    'permalink' => '',
                    'isPublished' => '',
                    'isPublic' => '',
                    'locales' => array(
                        'en_US' => array(
                            'content' => ''
                        )
                    )));
    }
    
    public function search($id) {
        $data = $this->httpRequest->getPost();
        
        $result = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $data);
        
        if(!is_array($result) || count($result) == 0) {
            return array('result' => false);
        }
        
        //maybe we've found ourself... check the id
        $item = current($result['Page']);
      
        return array('result' => ($item['id'] != $id));
    }
    
    public function savePermalink() {
        $data = $this->httpRequest->getPost();
        
        //$result = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $data);
        
        return array('result' => true);
    }
    
    public function save($id) {
        $data = $this->httpRequest->getPost();
        $data['page']['id'] = intval($id);
        $data['page']['Staff_id'] = $this->getLoggedInStaffId();
        
        $result = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $data['page']);
        
        return array('result' => true);
    }
    
    
    public function preview($id) {
        $data = array('id' => intval($id));
        
        $result = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $data);
       
        if(!is_array($result)) {
            $result = array();
        }
        
        return $result;
    }
    
    public function edit($id) {
      
        $params = array(
            'id' => intval($id)
        );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);                
        $data['sections'] = $this->httpRequest->getAttribute('Sections');
        $categoryID = array_key_exists('CmsCategories_id', $data)? $data['CmsCategories_id'] : '0';
        $data['sectionOptionsList'] = $this->formatSelectionBoxOptions($this->httpRequest->getAttribute('Sections'), array($categoryID), 'name');
       
        if(!array_key_exists('CmsPage', $data)) {
            $data['CmsPage'] = $this->getArray($id);
        }
        
        return $data;
    }
    
    public function viewByPermalink($section1, $section2 = '', $section3 = '') {
        $params = array();
        if(strlen($section3) > 0) {
            $params = array('permalink' => $section3);
        } elseif(strlen($section2) > 0) {
            $params = array('permalink' => $section2);
        } else {
            $params = array('permalink' => $section1);
        }       
     
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);                
        if(!is_array($data) || count($data) == 0) {
            throw new \Exception('Page Content Not Found');
        }
        
        return $data;
    }
}