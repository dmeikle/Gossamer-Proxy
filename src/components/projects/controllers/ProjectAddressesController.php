<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

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
 * @author Dave Meikle
 */
class ProjectAddressesController extends AbstractController {

    public function search() {
        $result = $this->model->search($this->httpRequest->getQueryParameters());

        $this->render($result);
    }

    public function get($id) {
        $result = $this->model->edit($id);

        $this->render(array('ProjectAddress' => $result));
    }

    public function edit($id) {
        //commented out for angular load
        //$result = $this->model->edit($id);
        $result = array();

        $result['form'] = $this->drawForm($this->model, $result);

        $this->render($result);
    }

    private function getYears() {
        $max_date = date("Y");
        $min_date = '1900';
        $retval = array();
        for ($start = $max_date; $start > $min_date; $start--) {
            $retval[] = $start;
        }

        return $retval;
    }

    public function save($id) {
        $result = $this->model->save($id);

        $this->render($result);
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $projectBuilder = new ProjectBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $provinceList = $this->httpRequest->getAttribute('Provinces');

        $provinceSerializer = new ProvinceSerializer();
        $selectedOptions = array($projectBuilder->getValue('Provinces_id', $values));
        $yearSerializer = new YearSerializer();
        $buildingYear = (array_key_exists('buildingYear', $values) ? $values['buildingYear'] : '');
        $options = array('provinces' => $provinceSerializer->formatSelectionBoxOptions($provinceSerializer->pruneList($provinceList), $selectedOptions),
            'years' => $yearSerializer->formatSelectionBoxOptions($yearSerializer->pruneList($this->getYears()), array($buildingYear)));

        return $projectBuilder->buildForm($builder, $values, $options, $results);
    }

    public function getForm($id) {
        $result = $this->model->edit($id);

        $this->render(array('form' => $this->drawForm($this->model, is_array($result) ? $result : array())));
    }

}
