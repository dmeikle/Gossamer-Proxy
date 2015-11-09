<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\vendors\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\vendors\form\VendorBuilder;
use components\geography\serialization\ProvinceSerializer;

class VendorsController extends AbstractController {

    /**
     * edit - display an input form based on requested id
     *
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        $result = $this->model->edit($id);

        $this->render(array('form' => $this->drawForm($this->model, $result)));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {

        $formBuilder = new FormBuilder($this->logger, $model);
        $builder = new VendorBuilder();

        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $options['locales'] = $this->httpRequest->getAttribute('locales');

        $serializer = new ProvinceSerializer();

        $options['provinces'] = $serializer->getOptions($this->httpRequest->getAttribute('Provinces'));

        return $builder->buildForm($formBuilder, $values, $options, $results);
    }

    public function listallPOS($offset, $limit) {
        $rawParams = $this->httpRequest->getQueryParameters();

        $params = array('Vendors_id' => intval($rawParams['Vendors_id']));
        if(array_key_exists('VendorLocations_id', $rawParams)) {
            $params['VendorLocations_id'] = intval($rawParams['VendorLocations_id']);
        }

        $result = $this->model->listallWithParams($offset, $limit, $params, 'list');

        $this->render($result);
    }

}
