<?php

namespace components\events\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\events\form\LocationBuilder;
use components\geography\serialization\ProvinceSerializer;


class EventLocationsController extends AbstractController
{
    public function edit($id) {
        $result = $this->model->edit($id);
        
        $this->render(array('form' => $this->drawForm($this->model, $result)));
    }
    
    public function save($id) {        
        parent::saveAndRedirect($id, 'admin_eventlocations_list', array(0,20));
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $builder = new LocationBuilder();
        $builder->setLocales($this->httpRequest->getAttribute('locales'));

        $options = array(
            'locales' => $this->httpRequest->getAttribute('locales')
        );
                  
        $provinceList = $this->httpRequest->getAttribute('Provinces');
       
        $provinceSerializer = new ProvinceSerializer();
        $selectedOptions = array($builder->getValue('Provinces_id', $values));
        
        $options = array('Provinces' => $provinceSerializer->formatSelectionBoxOptions($provinceSerializer->pruneList($provinceList), $selectedOptions));

        return $builder->buildForm($formBuilder, $values, $options, $results);
    }
}
