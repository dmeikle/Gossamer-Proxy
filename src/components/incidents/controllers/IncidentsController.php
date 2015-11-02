<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\incidents\controllers;

use core\AbstractController;
use components\incidents\form\IncidentTypeBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use core\system\Router;
use components\incidents\serialization\IncidentTypeSerializer;

/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class IncidentsController extends AbstractController {

    public function search() {
        $result = $this->model->search();

        $this->render($result);
    }

    public function edit($id) {
        $result = $this->model->edit($id);

        $this->render(array('locales' => $this->httpRequest->getAttribute('locales'), 'form' => $this->drawForm($this->model, $result)));
    }

    public function listall($offset = 0, $limit = 20) {
        $result = $this->model->listall($offset, $limit);
        $result['Departments'] = $this->httpRequest->getAttribute('Departments');

        $incidentTypeSerializer = new IncidentTypeSerializer();
        $result['IncidentTypesList'] = $incidentTypeSerializer->extractRawChildNodeData($this->httpRequest->getAttribute('IncidentTypes'), 'incidentType', true);

        $this->render($result);
    }

    /**
     * save - saves/updates row
     *
     * @param int id    primary key of item to save
     */
    public function save($id) {

        $result = $this->model->save($id);

        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_incidenttypes_list', array(0, 20));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $builder = new IncidentTypeBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $options = array();
        $options['locales'] = $this->httpRequest->getAttribute('locales');

        $sectionsList = $this->httpRequest->getAttribute('Sections');

        $incidentTypeSerializer = new IncidentTypeSerializer();
        $rawTypeSections = array();
        if (!is_null($values) && array_key_exists('IncidentTypeSection', $values)) {
            $rawTypeSections = $values['IncidentTypeSection'];
            $incidentTypeSections = $incidentTypeSerializer->extractRawChildNodeData($rawTypeSections, 'Sections_id');
            $options['Sections_id'] = $incidentTypeSerializer->formatSelectionBoxOptions($sectionsList, $incidentTypeSections, 'section');
        }

        $options['scores'] = $this->getScores($values);

        return $builder->buildForm($formBuilder, $values, $options, $results);
    }

    private function getScores(array $values = null) {

        $scoreId = 0;
        if (is_array($values) && array_key_exists('score', $values)) {
            $scoreId = $values['score'];
        }

        $retval = '';

        for ($i = 1; $i < 10; $i++) {
            $retval .= '<option value="' . $i . '"';
            if ($i == $scoreId) {
                $retval .= " selected";
            }
            $retval .= ">$i</option>\r\n";
        }

        return $retval;
    }

}
