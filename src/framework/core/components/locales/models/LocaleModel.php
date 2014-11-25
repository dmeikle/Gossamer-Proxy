<?php

namespace core\components\locales\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * Description of LocaleModel
 *
 * @author Dave Meikle
 */ 
class LocaleModel extends AbstractModel
{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Locale';
        $this->tablename = 'locales';        
    }
    
    public function change() {
        $params = $this->httpRequest->getPost();
        $this->setDefaultLocale($params['locale']);
    }
    
    public function setDefaultLocale($locale) {
       
        $userPreferences = getSession('userPreferences');
       
        if(is_null($userPreferences) || !is_array($userPreferences)) {
            $userPreferences = array();            
        }
        $locales = $this->httpRequest->getAttribute('locales');
        $userPreferences['defaultLocale'] = $locales[$locale];
        setSession('userPreferences', $userPreferences);      
    }
    
    
    public function listall($offset = 0, $rows = 20, $customVerb = NULL) {
      
        $params = array(
            //'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit, 'directive::ORDER_BY' => 'Products.id asc'
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows
        );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);
        
        if(array_key_exists(ucfirst($this->tablename) . 'Count', $data)) {
            $data['pagination'] = $this->getPagination($data[ucfirst($this->tablename) . 'Count'], $offset, $rows);
        }
        $this->render($data);
    }
    
    
    public function edit($id) {
       
        $params = array(
            'id' => intval($id)
        );
     
        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        $data['thumbnails'] = $this->getFileList(__SITE_PATH . "/images/flags/");
        $this->render($data);
    }
    
    public function save($id) {

        $params = $this->httpRequest->getPost();
        $params['locale']['id'] = $id;

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['locale']);       
      
        
        //$this->render($data);
    }
}