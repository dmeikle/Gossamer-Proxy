<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\customers\controllers;

use core\AbstractController;
use components\customers\serialization\CustomerSerializer;
use components\customers\serialization\CustomerTypeSerializer;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\customers\form\CustomerBuilder;
use components\customers\form\CustomerDisplayBuilder;
use core\system\Router;

class CustomersController extends AbstractController {

    /**
     * edit - display an input form based on requested id
     *
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        $result = $this->model->edit($id);


        if (is_array($result) && array_key_exists('Customer', $result)) {
            $contact = $result['Customer'];
            $result['form'] = $this->drawForm($this->model, $contact);
        } else {
            $result['form'] = $this->drawForm($this->model, array());
        }

        $this->render($result);
    }

    /**
     * save - saves/updates row
     *
     * @param int id    primary key of item to save
     */
//    public function save($id) {
//
//        $result = $this->model->save($id);
////        pr($result);
////        pr($result['Customer']);
////        pr($result['Customer']['id']);
//        $router = new Router($this->logger, $this->httpRequest);
//        $router->redirect('admin_Customer_credentials_get', array($result['Customer']['id']));
//    }

    public function view() {
        $result = $this->model->view();

        $this->render(array('form' => $this->drawDisplay($this->model, $result['Customer'])));
    }

    public function CustomerSearchResults() {
        $results = $this->httpRequest->getAttribute('Customers');

        if (is_array($results)) {
            $serializer = new CustomerSerializer();
            $results = $serializer->formatCustomerSearchResults($results);
        } else {
            $results = array();
        }

        $this->render($results);
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {

        $builder = new FormBuilder($this->logger, $model);
        $contactBuilder = new CustomerBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');
        $contactTypes = $this->httpRequest->getAttribute('CustomerTypes');
        $contactTypeSerializer = new CustomerTypeSerializer();
        $contactTypesList = $contactTypeSerializer->formatCustomerTypesList($contactTypes, $values);
        unset($contactTypeSerializer);

        $options = array(
            'companies' => array(),
            'contactTypes' => $contactTypesList
        );

        return $contactBuilder->buildForm($builder, $values, $options, $results);
    }

    protected function drawDisplay(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $displayBuilder = new CustomerDisplayBuilder();


        return $displayBuilder->buildForm($builder, $values);
    }

    public function load() {
        $result = $this->model->view();

        $this->render(array('form' => $this->drawForm($this->model, $result['Customer'])));
    }

    public function saveInfo() {
        $result = $this->model->save($this->model->getLoggedInStaffId());

        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('portal_contact_settings');
    }

    public function listallByFriendId($offset, $limit) {
        $filter = array(
            'Customers_id' => $this->model->getLoggedInStaffId()
        );

        $results = $this->model->listallWithParams($offset, $limit, $filter);

        $this->render($results);
    }

    public function findByEmail() {
        $params = $this->httpRequest->getPost();
        $result = $this->model->findByEmail($params['email']);

        $this->render($result);
    }

}
