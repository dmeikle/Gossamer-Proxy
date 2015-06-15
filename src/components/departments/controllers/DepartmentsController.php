<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\departments\controllers;

use core\AbstractController;
use components\departments\form\DepartmentBuilder;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\system\Router;

class DepartmentsController extends AbstractController {

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
        $departmentBuilder = new DepartmentBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');       

        $options = array();

        return $departmentBuilder->buildForm($builder, $values, $options, $results);
    }


    public function getFormWrapper() {
        return $this->entity;
    }

}