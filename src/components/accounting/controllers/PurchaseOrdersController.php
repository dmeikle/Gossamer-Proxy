<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\accounting\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\accounting\form\PurchaseOrderBuilder;

/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class PurchaseOrdersController extends AbstractController {

    
    /**
     * edit - display an input form based on requested id
     *
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        //$result = $this->model->edit($id);

//        $this->render(array('form' => $this->drawForm($this->model)));
        $this->render(array());
    }
    
    public function get($id) {
        $purchaseOrder = $this->model->edit($id);
        $this->render(array('PurchaseOrder' => $purchaseOrder));
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $this->model);
        $poBuilder = new PurchaseOrderBuilder();
        
        return $poBuilder->buildForm($builder);
    }
}
