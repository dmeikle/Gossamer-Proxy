<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\documents\controllers;

use core\AbstractController;
use components\documents\form\DocumentBuilder;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\navigation\Pagination;

class DocumentsController extends AbstractController {
//    public function save($id) {
//
//        $result = $this->getEntity('Staff', $this->model->save($id));
//        $entity = $this->getEntity('Staff', $result);
//
//        //TODO: figure out where to redirect if result holds no 'id' key
//        $router = new Router($this->logger, $this->httpRequest);
//        $router->redirect('admin_staff_credentials_edit', array($result['id']));
//    }

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
        $builder = new FormBuilder($this->logger, $model);
        $documentBuilder = new DocumentBuilder;
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $options = array();

        return $documentBuilder->buildForm($builder, $values, $options, $results);
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    public function uploadDocuments($jobNumber, $locationId = 0) {
        $filenames = array();
        $claimDocumentPath = $this->model->getUploadPath() . DIRECTORY_SEPARATOR . $jobNumber . DIRECTORY_SEPARATOR;

        if (intval($locationId) > 0) {
            $claimDocumentPath .= intval($locationId) . DIRECTORY_SEPARATOR;
        }

        $this->mkdir($claimDocumentPath);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $claimDocumentPath . $_FILES['file']['name'])) {
            $params = array('id' => intval($id), 'imageName' => $_FILES['file']['name']);

            $this->model->saveParams($params);
        }

        $this->render(array('success' => 'true'));
    }

    /**
     * listall - retrieves rows based on offset, limit
     *
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listall($offset = 0, $limit = 20) {
        $params = $this->httpRequest->getQueryParameters();
        $result = $this->model->listallWithParams($offset, $limit, $params, 'list');

        if (is_array($result) && array_key_exists($this->model->getEntity() . 'sCount', $result)) {
            $pagination = new Pagination($this->logger);

            //CP-33 changed to json output for new Angular based page draws
            $result['pagination'] = $pagination->getPaginationJson($result[$this->model->getEntity() . 'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());
            unset($pagination);
        }

        $serializer = new \components\claims\serialization\ClaimDocumentSerializer();
        if (array_key_exists('Documents', $result)) {
            $result = $serializer->groupDocuments($result['Documents']);
        }

        $this->render(array('Documents' => $result));
    }

}
