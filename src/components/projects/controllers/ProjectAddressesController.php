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
class ProjectAddressesController extends AbstractController{
   
    public function search() {
        $result = $this->model->search();
        
        $this->render($result);
    }
    
    public function edit($id) {       
        $result = $this->model->edit($id);
        
        $result['form'] = $this->drawForm($this->model, $result);
        
        $this->render($result);
    }
    
    private function getYears() {
        $max_date = date("Y");
        $min_date = '1900';
        $retval = array();
        for($start = $max_date; $start > $min_date; $start--) {
            $retval[] = $start;
        }
        
        return $retval;
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
