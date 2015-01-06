<?php
namespace components\projects\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\projects\form\ProjectBuilder;
use components\geography\serialization\ProvinceSerializer;
use components\projects\serialization\YearSerializer;
use core\system\Router;


/**
 * Description of PropertiesController
 *
 * @author davem
 */
class ProjectsController extends AbstractController{
   
    
    public function listallByContact($offset = 0, $limit = 20) {        
        $result = $this->model->listallByContactType($offset, $limit, $this->getLoggedInStaffId());
        
        $this->render($result);
    }
    
    public function listallByCompany($offset = 0, $limit = 20) {
        $loggedInUser = $this->httpRequest->getAttribute('components\\contacts\\models\\ContactModel');
        
        //$user = $this->getL
        $result = $this->model->listallByCompany($offset, $limit, $loggedInUser['Companies_id']);
        
        $this->render($result);
    }
    
    public function search() {
        $result = $this->model->search();
        
        $this->render($result);
    }
    
    public function edit($id) {       
        $result = $this->model->edit($id);
        
        $result['form'] = $this->drawForm($this->model, $result);
        
        $this->render($result);
    }
    
    public function save($id) {       
        $result = $this->model->save($id);
        
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('projectaddress_list', array('0', '20'));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $projectBuilder = new ProjectBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
               
        $provinceList = $this->httpRequest->getAttribute('Provinces');
       
        $provinceSerializer = new ProvinceSerializer();
        $selectedOptions = array($projectBuilder->getValue('Provinces_id', $values));
        $yearSerializer = new YearSerializer();
        
        $options = array('provinces' => $provinceSerializer->formatSelectionBoxOptions($provinceSerializer->pruneList($provinceList), $selectedOptions), 
            'years' => $yearSerializer->formatSelectionBoxOptions($yearSerializer->pruneList($this->getYears()), array($values['buildingAge'])));
        
        return $projectBuilder->buildForm($builder, $values, $options, $results);
    }
}
