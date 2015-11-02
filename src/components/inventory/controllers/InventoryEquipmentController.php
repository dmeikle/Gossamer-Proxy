<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\inventory\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use core\navigation\Pagination;
use core\serialization\Serializer;
use components\inventory\form\InventoryEquipmentBuilder;
use components\inventory\serialization\PackageTypeSerializer;
use components\inventory\serialization\InventoryTypeSerializer;

class InventoryEquipmentController extends AbstractController {

    public function listAllEquipment($offset = 0, $limit = 20) {
        $results = $this->model->listallWithParams($offset, $limit, array('InventoryTypes_id' => 2));

        $this->renderResults($offset, $limit, $results);
    }

    public function transfer() {
        $staff = $this->httpRequest->getAttribute('StaffAuthorization');

        if (!is_null($staff)) {
            $params = $this->httpRequest->getPost();
            $params['signingStaff_id'] = $staff['Staff_id'];
            unset($params['Staff']);
            $result = $this->model->transfer($params);
        } else {
            $result = array('success' => 'false', 'message' => 'invalid user credentials');
            //TODO: this would be a recommended spot for calling event dispatcher to increment failed logins
        }

        $this->render($result);
    }

    public function listHistory($offset = 0, $limit = 20) {
        $params = array();
        $queryParams = $this->httpRequest->getQueryParameters();

        if (array_key_exists('InventoryEquipment_id', $queryParams)) {
            $params['InventoryEquipment_id'] = $queryParams['InventoryEquipment_id'];
        }
        $result = $this->model->listAllWithParams($offset, $limit, $params, 'transferhistory');

        $this->render($result);
    }

    public function get($id) {
        $result = $this->model->edit(intval($id));

        $this->render($result);
    }

    public function edit($id) {

        $result = $this->model->edit(intval($id));

        if (array_key_exists('InventoryEquipment', $result)) {
            $result = current($result['InventoryEquipment']);
        }
        $this->render(array('form' => $this->drawForm($this->model, $result)));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $inventoryEquipmentBuilder = new InventoryEquipmentBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        $options = array();

        $rawPackageTypes = $this->httpRequest->getAttribute('PackageTypes');
        $serializer = new PackageTypeSerializer();
        $options['packageTypes'] = $serializer->formatTypesList($rawPackageTypes, $values);

        $rawInventoryTypes = $this->httpRequest->getAttribute('InventoryTypes');
        $serializer = new InventoryTypeSerializer();
        $options['inventoryTypes'] = $serializer->formatTypesList($rawInventoryTypes, $values);

        return $inventoryEquipmentBuilder->buildForm($builder, $values, $options, $results);
    }

}
