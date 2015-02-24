<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\surveys\controllers;


use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\surveys\serialization\QuestionTypeSerializer;
use components\surveys\form\TextBoxQuestionBuilder;
use components\surveys\form\MultipleChoiceQuestionBuilder;
use core\system\Router;
use core\navigation\Pagination;
use components\surveys\serialization\QuestionSerializer;


/**
 * Description of SheetQuestionsController
 *
 * @author Dave Meikle
 */
class QuestionsController extends AbstractController{
 
    
    public function editQuestion($questionTypeId, $id) {
        $results = $this->model->edit($id);
        
        $results['QuestionTypes_id'] = $questionTypeId;
        
        $answers = $this->drawAnswerList( $this->httpRequest->getAttribute('AnswersList') );
        
        $this->render(array('locales' => $this->httpRequest->getAttribute('locales'), 'answers' => $answers,
            'form' => $this->drawForm($this->model, $results), 'QuestionTypes_id' => $results['QuestionTypes_id']));
    }
    
    public function saveQuestion($questionTypeId, $id) {
        $results = $this->model->save($id);
        
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_surveys_questions_list', array(0, 20));
    }
    
    public function listall($offset = 0, $limit = 20) {
        $results = $this->model->listall($offset, $limit);
        
        $questionTypeSerializer = new QuestionTypeSerializer();
        $results['QuestionTypesList'] = $questionTypeSerializer->extractRawChildNodeData($this->httpRequest->getAttribute('QuestionTypes'), 'type', true);
        
        if(is_array($results) && array_key_exists($this->model->getEntity() .'sCount', $results)) {
            $pagination = new Pagination($this->logger);        
            $results['pagination'] = $pagination->paginate($results[$this->model->getEntity() .'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());       
            unset($pagination);
        }
        
        $this->render($results);
    }
    
    public function listallBySurvey($surveyId) {
        $results = $this->model->listallBySurvey($surveyId);
                
        $this->render($results);
    }
    
    public function drawForm(FormBuilderInterface $model, array $values = null) {
      
        $formBuilder = new FormBuilder($this->logger, $model);
        $builder = $this->getBuilder($values);
      
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        $questionTypesList = $this->httpRequest->getAttribute('QuestionTypes');
     
        $serializer = new QuestionTypeSerializer($this->logger);
        $selectedOptions = array();
        
        if(is_array($values)) {
            array($builder->getValue('QuestionTypes_id', $values));      
        }

        $options = array('questiontypes' => $serializer->formatSelectionBoxOptions($questionTypesList, $selectedOptions, 'type', $values['QuestionTypes_id']));
       
        $options['locales'] = $this->httpRequest->getAttribute('locales');
    
        return $builder->buildForm($formBuilder, $values, $options, $results);
    }
    
    private function getBuilder(array $values = null) {
        if(!is_array($values) || !array_key_exists('QuestionTypes_id', $values)) {
          
            return new TextBoxQuestionBuilder();
        }
        
        switch($values['QuestionTypes_id']) {
         
            case 1:
               
                return new MultipleChoiceQuestionBuilder();
            default:
                
                return new TextBoxQuestionBuilder();
        }
    }
    
    private function drawAnswerList(array $answers = null) {
        if(!is_array($answers) || count($answers) < 1) {
            return;
        }
        $retval = '<ul id="sortable">';
        foreach($answers as $answer) {
            if(!array_key_exists('id', $answer)) {
                continue;
            }
            $retval .= '<li data-id="' . $answer['id'] . '" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' . $answer['answer'] . '</li>';  
        }
        $retval .= '</ul>';
        
        return $retval;
    }
    
    public function search() {
        $result = $this->model->search();
        
        $serializer = new QuestionSerializer();
        $result = $serializer->formatSearchResults($result);
        
        $this->render($result);
    }

}
