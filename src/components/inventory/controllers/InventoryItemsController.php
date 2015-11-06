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
use components\inventory\form\InventoryItemBuilder;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\system\Router;
use core\navigation\Pagination;
use core\serialization\Serializer;
use components\inventory\serialization\PackageTypeSerializer;
use components\inventory\serialization\InventoryTypeSerializer;

class InventoryItemsController extends AbstractController {

    /**
     * edit - display an input form based on requested id
     *
     * @param int id    primary key of item to edit
     */
    public function edit($id) {

        $result = $this->model->edit($id);

        $this->httpRequest->setAttribute('inventoryItem', $result);

        $this->render(array());
    }

    public function save($id) {
        $result = $this->model->save($id);

        $this->render($result);
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $inventoryItemBuilder = new InventoryItemBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        $options = array();

        $rawPackageTypes = $this->httpRequest->getAttribute('PackageTypes');
        $serializer = new PackageTypeSerializer();
        $options['packageTypes'] = $serializer->formatTypesList($rawPackageTypes, $values);

        $rawInventoryTypes = $this->httpRequest->getAttribute('InventoryTypes');
        $serializer = new InventoryTypeSerializer();
        $options['inventoryTypes'] = $serializer->formatTypesList($rawInventoryTypes, $values);

        return $inventoryItemBuilder->buildForm($builder, $values, $options, $results);
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    /**
     * listall - retrieves rows based on offset, limit
     *
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listall($offset = 0, $limit = 20) {
        $results = $this->model->listall($offset, $limit);

        $this->renderResults($offset, $limit, $results);
    }

    protected function renderResults($offset, $limit, array $result) {

        if (is_array($result) && array_key_exists($this->model->getEntity() . 'sCount', $result)) {
            $pagination = new Pagination($this->logger);
            $result['pagination'] = $pagination->paginate($result[$this->model->getEntity() . 'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());
            unset($pagination);
        }

        $serializer = new Serializer();

        $rawPackageTypes = $this->httpRequest->getAttribute('PackageTypes');
        $packageTypes = $serializer->extractRawChildNodeData($rawPackageTypes, 'name', 'id');

        $rawInventoryTypes = $this->httpRequest->getAttribute('InventoryTypes');
        $inventoryTypes = $serializer->extractRawChildNodeData($rawInventoryTypes, 'name', 'id');

        $result['inventoryTypes'] = $inventoryTypes;
        $result['packageTypes'] = $packageTypes;

        $this->render($result);
    }

    public function saveVariantOptions($id) {
        $result = $this->model->saveVariantOptions($id);

        $this->render($result);
    }

}
