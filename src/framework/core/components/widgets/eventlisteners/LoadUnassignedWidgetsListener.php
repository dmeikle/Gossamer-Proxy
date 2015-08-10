<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace core\components\widgets\eventlisteners;

use core\eventlisteners\AbstractCachableListener;
use core\components\widgets\models\WidgetModel;
use core\navigation\Pagination;

/**
 * LoadSystemWidgetsListener
 *
 * @author Dave Meikle
 */
class LoadUnassignedWidgetsListener extends AbstractCachableListener{
    
    public function on_request_start($params) {
     
        $results = $this->loadConfigurations($params);
   
        $this->saveValuesToCache($this->getKey(), $results);
        if(is_array($results) && array_key_exists('Widgets', $results)) {
            $this->httpRequest->setAttribute($this->getKey(), $results);
        } else {
            $this->httpRequest->setAttribute($this->getKey(), array());
        }
        
    }
    
    private function loadConfigurations($params) {

        $model = new WidgetModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = $this->httpRequest->getParameters();
        $offset =  intval($params[1]);
        $limit = intval($params[2]);
       
        $params = array('pageId' => intval($params[0]),
            'directive::OFFSET' =>$offset,
            'directive::LIMIT' => $limit);
        
        $datasource = $this->getDatasource($model);
 
        $result = $datasource->query('get', $model, 'listunused', $params);      
        
        if (is_array($result) && array_key_exists($model->getEntity() . 'sCount', $result)) {
            $pagination = new Pagination($this->logger);
           
            //CP-33 changed to json output for new Angular based page draws
            $result['pagination'] = $pagination->getPaginationJson($result[$model->getEntity() . 'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());
            unset($pagination);
        }
        
        return $result;
    }
    
    
    /**
     * 
     * @return string
     */
    protected function getUriWithoutOffsetLimit() {
        $pieces = explode('/', __URI);
        array_pop($pieces);
        array_pop($pieces);

        return '/' . implode('/', $pieces);
    }
    
    protected function getKey() {
        $params = $this->httpRequest->getParameters();
             
        return 'widgets' . DIRECTORY_SEPARATOR . 'unassignedWidgets_' . intval($params[0]) . '_' . intval($params[1]) . '_' . intval($params[2]);
    }
}
