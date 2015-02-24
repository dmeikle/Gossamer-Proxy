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
use components\surveys\models\AnswerModel;
use core\eventlisteners\Event;

/**
 * Description of LoadAnswersByQuestionListener
 *
 * @author Dave Meikle
 */
class SaveQuestionAnswersListener extends AbstractListener{
    
    public function on_save_success(Event $event) {
        
        $params = $event->getParams();
        $postedParams = $this->httpRequest->getPost();
        if(array_key_exists('Question', $params)) {
            $question =  current($params['Question']);            
         
            if(!is_array($question) || count($question) < 1) {
                
                return;
            }
        }
        
        $model = new AnswerModel($this->httpRequest, $this->httpResponse, $this->logger);
           
        if(!array_key_exists('answerId', $postedParams)) {
            //nothing to save
            return;
        }  
        $params = array('Questions_id' => intval($params['Question'][0]['id']), 'answerIds' => $postedParams['answerId']);
        $datasource = $this->getDatasource('components\surveys\models\AnswerModel');
    
        $datasource->query('POST', $model, 'saveQuestionAnswers', $params);

        unset($model);
    }
    
    public function on_request_start($params) {
        $params = $this->httpRequest->getParameters();
        $questionId = intval($params[0]);
        $postedParams = $this->httpRequest->getPost();
        $model = new AnswerModel($this->httpRequest, $this->httpResponse, $this->logger);
           
          
        $params = array('Questions_id' => $questionId, 'answerIds' => $postedParams['Answers_id']);
        $datasource = $this->getDatasource('components\surveys\models\AnswerModel');
    
        $datasource->query('POST', $model, 'saveQuestionAnswers', $params);

        unset($model);
    }
}
