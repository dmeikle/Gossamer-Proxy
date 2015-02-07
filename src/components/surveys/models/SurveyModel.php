<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\surveys\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;



/**
 * Description of ScopingFormModel
 *
 * @author Dave Meikle
 */
class SurveyModel extends AbstractModel implements FormBuilderInterface{
    
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger)  {
        parent::__construct($httpRequest, $httpResponse, $logger);
        
        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
        
        $this->entity = 'Survey';
        $this->tablename = 'surveys';        
    }

    public function getFormWrapper() {
        return $this->entity;
    }
    
    public function save($id) {
        $params = $this->httpRequest->getPost();
        $params[$this->entity]['id'] = intval($id);
        $params[$this->entity]['Staff_id'] = $this->getLoggedInStaffId();        
      
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);
        
        return $data;
    }
    
    public function getFullSurvey($permalink, $page) {
        $locale = $this->getDefaultLocale();
        
        $params = array(
            'permalink' => $permalink,
            'page' => $page,
            'locale' => $locale['locale']
        );
        
        $data = $this->dataSource->query(self::METHOD_GET, $this, 'getSurveyPage', $params);
        
        return $data;
    }
    
    public function saveFullSurvey($permalink, $page) {
        $params = $this->httpRequest->getPost();
        pr($params);
        die;
        $params[$this->entity]['id'] = intval($id);
        $params[$this->entity]['Staff_id'] = $this->getLoggedInStaffId();        
      
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);
        
        return $data;
    }

}
