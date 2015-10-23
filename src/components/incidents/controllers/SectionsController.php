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
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\incidents\form\SectionBuilder;
use core\system\Router;

/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class SectionsController extends AbstractController {

    public function search() {
        $result = $this->model->search();

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
        $router->redirect('admin_sections_list', array(0, 20));
    }

    public function edit($id) {
        $result = $this->model->edit($id);

        $this->render(array('form' => $this->drawForm($this->model, $result)));
    }

    public function listall($offset = 0, $rows = 0) {
        $result = $this->model->listall($offset, $rows);

        $this->render($result);
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $builder = new SectionBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $options = array();

        return $builder->buildForm($formBuilder, $values, $options, $results);
    }

}
