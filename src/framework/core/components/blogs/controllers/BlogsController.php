<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 * 
 */

namespace core\components\blogs\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\components\blogs\form\BlogBuilder;    
use Gossamer\CMS\Forms\FormBuilder;
use components\staff\serialization\StaffSerializer;
use core\eventlisteners\Event;


/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class BlogsController extends AbstractController{
   
    public function search() {
        $result = $this->model->search();
        
        $this->render($result);
    }
    
    public function showCalendar($year, $month) {
        $result = $this->model->showCalendar($year, $month);
        
        $this->render($result);
    }
    public function listByDate($year, $month) {
        $result = $this->model->listByDate($year, $month);
        
        $this->render($result);
    }
    public function save($id) {
        parent::saveAndRedirect($id, 'admin_blogs_list', array(0,20));
    }
    
    
    
    public function edit($id) {
        $result = $this->model->edit($id);
        
        $this->render(array('locales' => $this->httpRequest->getAttribute('locales'), 'form' => $this->drawForm($this->model, $result), 'page' => $result));
    }
    
    public function view($id) {
        
        $result = $this->model->get($id);
       
        if(array_key_exists('Blog', $result)) {
            $result = current($result['Blog']);
        }
        $event = new Event('load_complete', $result);
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'load_complete', $event);
       
        $params = $event->getParams();
        
        $serializer = new StaffSerializer();
        $staffName = $serializer->getStaffName($params['staff'], $result['Author_id']);
     
        $this->render(array('blog' =>$result, 'staffName' => $staffName));
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $blogBuilder = new BlogBuilder();
        
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
       
        
        $options = array(
            'locales' => $this->httpRequest->getAttribute('locales')
        );
      
        return $blogBuilder->buildForm($builder, $values, $options, $results);    
    }
}
