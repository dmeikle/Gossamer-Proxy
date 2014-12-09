<?php

namespace components\surveys\controllers;


use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use core\system\Router;
use components\surveys\form\AnswerBuilder;
use components\surveys\serialization\AnswerSerializer;


/**
 * Description of SheetQuestionsController
 *
 * @author davem
 */
class AnswersController extends AbstractController{
    
    public function search() {
        $result = $this->model->search();
        
        $serializer = new AnswerSerializer();
        $result = $serializer->formatSearchResults($result);
        
        $this->render($result);
    }
    
    public function edit($id) {
        $results = $this->model->edit($id);       
       
        $this->render(array('locales' => $this->httpRequest->getAttribute('locales'), 'form' => $this->drawForm($this->model, $results)));
    }
    
    public function save($id) {        
        $results = $this->model->save($id);       
       
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_surveys_answers_list', array(0, 20));
    }
    
    public function listall($offset = 0, $limit = 20) {
        $results = $this->model->listall($offset, $limit);
        
        $this->render($results);
    }
    
    public function drawForm(FormBuilderInterface $model, array $values = null) {
      
        $formBuilder = new FormBuilder($this->logger, $model);
        $builder = new AnswerBuilder();
      
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        $questionTypesList = $this->httpRequest->getAttribute('QuestionTypes');
            
        $options['locales'] = $this->httpRequest->getAttribute('locales');
    
        return $builder->buildForm($formBuilder, $values, $options, $results);
    }
    
}
