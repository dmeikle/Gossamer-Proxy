<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\surveys\listeners;

use core\eventlisteners\AbstractListener;
use components\surveys\models\SurveyPaneModel;


/**
 * Description of LoadSurveyPaneListener
 *
 * @author Dave Meikle
 */
class LoadSurveyPaneListener extends AbstractListener{
    
    public function on_request_start($params) {
     
       $requestParams = ($this->httpRequest->getParameters()) ;
       $retval = array();
       $model = new SurveyPaneModel($this->httpRequest, $this->httpResponse, $this->logger);
 
       $defaultLocale =  $this->getDefaultLocale();
       $params = array('locale '=> $defaultLocale['locale'], 'id' => intval($requestParams[0]));
       $datasource = $this->getDatasource('components\surveys\models\SurveyPaneModel');
       
       $result = current($datasource->query('get', $model, 'get', $params));
       if(is_array($result) && count($result) > 0) {
          //send it straight to the response - not needed in any other processes
        $this->httpResponse->setAttribute('SurveyPane', current($result)); 
       }
       
        unset($model);
    }
}
