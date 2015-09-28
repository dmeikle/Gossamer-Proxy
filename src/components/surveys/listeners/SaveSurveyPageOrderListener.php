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
use components\surveys\models\SurveyPageModel;
use core\eventlisteners\Event;

/**
 * Description of LoadAnswersByQuestionListener
 *
 * @author Dave Meikle
 */
class SaveSurveyPageOrderListener extends AbstractListener{
    
  
    
    public function on_request_start($params) {
        $params = $this->httpRequest->getParameters();
        $id = intval($params[0]);
        $postedParams = $this->httpRequest->getPost();
        $model = new SurveyPageModel($this->httpRequest, $this->httpResponse, $this->logger);
           
        $params = array('Survey_id' => intval($id), 'SurveyPages_id' => $postedParams['SurveyPages_id']);
        $datasource = $this->getDatasource('components\surveys\models\SurveyPageModel');
    
        $datasource->query('POST', $model, 'saveSurveyPages', $params);

        unset($model);
    }
}
