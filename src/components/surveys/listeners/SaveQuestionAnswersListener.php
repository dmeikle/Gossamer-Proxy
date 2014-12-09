<?php

namespace components\surveys\listeners;

use core\eventlisteners\AbstractListener;
use components\surveys\models\AnswerModel;
use core\eventlisteners\Event;

/**
 * Description of LoadAnswersByQuestionListener
 *
 * @author davem
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
           
            
        $params = array('Questions_id' => intval($params['Question'][0]['id']), 'answerIds' => $postedParams['answerId']);
        $datasource = $this->getDatasource('components\surveys\models\AnswerModel');
     
        $datasource->query('POST', $model, 'saveQuestionAnswers', $params);

        unset($model);
    }
}
