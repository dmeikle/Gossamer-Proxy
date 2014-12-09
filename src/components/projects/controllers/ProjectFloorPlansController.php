<?php
namespace components\projects\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\projects\form\FloorPlanBuilder;
use components\geography\serialization\ProvinceSerializer;
use components\projects\serialization\YearSerializer;
use core\system\Router;


/**
 * Description of PropertiesController
 *
 * @author davem
 */
class ProjectFloorPlansController extends AbstractController{
   
    
    public function editFloorPlan($projectId, $floorPlanId) {       
        $result = $this->model->editFloorPlan($projectId, $floorPlanId);
        
        $result['form'] = $this->drawForm($this->model, $result);
                
        $this->render($result);
    }
    
    public function listByProject($id) {
       
        $result = $this->model->listByProject($id);
        $result['projectAddressId'] = intval($id);
   
        $this->render($result);
    }
    
    public function saveFloorPlan($projectId, $floorPlanId) {       
        $result = $this->model->saveFloorPlan($projectId, $floorPlanId);
        
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('floorplans_list', array($projectId));
    }
    
    public function delete($projectId) {
        $params = $this->httpRequest->getPost();
        
        $this->model->remove($projectId, $params['floorplan']['id']);
        
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('floorplans_list', array($projectId));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $floorPlanBuilder = new FloorPlanBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');        
        
        $options = array();
       
        return $floorPlanBuilder->buildForm($builder, $values, $options, $results);
    }
}
