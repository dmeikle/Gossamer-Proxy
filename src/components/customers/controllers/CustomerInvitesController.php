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
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\customers\form\CustomerBuilder;
use components\customers\form\CustomerInviteBuilder;
use core\system\Router;

class CustomerInvitesController extends AbstractController {

    /**
     * edit - display an input form based on requested id
     *
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        $result = $this->model->edit($id);

        $this->render(array('form' => $this->drawForm($this->model, $result)));
    }

    /**
     * save - saves/updates row
     *
     * @param int id    primary key of item to save
     */
    public function save($id) {

        $result = $this->model->save($id);
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('portal_contact_invites_list', array(0, 20));
    }

    public function view() {
        $result = $this->model->view();

        $this->render($result);
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
        $contactBuilder = new CustomerInviteBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $options = array(
            'companies' => array(),
            'contactTypes' => array()
        );
        return $contactBuilder->buildForm($builder, $values, $options, $results);
    }

    public function listall($offset = 0, $limit = 0) {
        $filter = array(
            'InviterCustomers_id' => $this->model->getLoggedInStaffId()
        );

        $results = $this->model->listallWithParams($offset, $limit, $filter);

        $this->render($results);
    }

    public function invite() {
        $this->render(array('form' => $this->drawForm($this->model, array())));
    }

}
