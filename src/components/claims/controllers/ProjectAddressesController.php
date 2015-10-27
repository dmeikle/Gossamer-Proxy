<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\controllers;

use core\AbstractController;
use components\companies\serialization\CompanyTypeSerialization;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use components\claims\form\ProjectAddressBuilder;
use core\system\Router;

/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class ProjectAddressesController extends AbstractController {

    public function searchByStrataNumber() {
        $params = $this->httpRequest->getPost();

        $result = $this->model->search(array('strataNumber' => $params['term']));

        $this->render($result);
    }

    public function edit($id) {
        $result = $this->model->edit($id);
        $companyTypes = $this->httpRequest->getAttribute('CompanyTypes');

        if (!is_null($companyTypes)) {
            $serializer = new CompanyTypeSerialization();
            $companyTypes = $serializer->pruneCompanyTypes($companyTypes);

            $companyTypesOptions = $serializer->formatSelectionBoxOptions($companyTypes, array());
            $result['companyTypesOptions'] = $companyTypesOptions;
        }

        $this->render(array('form' => $this->drawForm($this->model, $result)));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $claimBuilder = new ProjectAddressBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $provinceSerializer = new \components\geography\serialization\ProvinceSerializer();

        $options = array(
            'provinces' => $provinceSerializer->formatSelectionBoxOptions($this->httpRequest->getAttribute('Provinces'), array(), 'province')
        );

        return $claimBuilder->buildForm($builder, $values, $options, $results);
    }

}
