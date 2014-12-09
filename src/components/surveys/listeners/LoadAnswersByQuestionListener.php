<?php

namespace components\surveys\listeners;

use core\eventlisteners\AbstractListener;
use components\surveys\models\AnswerModel;


/**
 * Description of LoadAnswersByQuestionListener
 *
 * @author davem
 */
class LoadAnswersByQuestionListener extends AbstractListener{
    
    public function on_request_start($params) {
       $requestParams = ($this->httpRequest->getParameters()) ;
       $retval = array();
       $model = new AnswerModel($this->httpRequest, $this->httpResponse, $this->logger);
 
       $defaultLocale =  $this->getDefaultLocale();
       $params = array('locale '=> $defaultLocale['locale'], 'Questions_id' => intval($requestParams[1]));
       $datasource = $this->getDatasource('components\surveys\models\AnswerModel');
       
       $answers = current($datasource->query('get', $model, 'listQuestionAnswers', $params));

        $this->httpRequest->setAttribute('AnswersList', $answers);
        unset($model);
    }
}
