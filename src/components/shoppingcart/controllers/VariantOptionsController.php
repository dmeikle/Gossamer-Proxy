<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\shoppingcart\controllers;

use core\AbstractController;

class VariantOptionsController extends AbstractController
{
   
    public function getOptionsByVariantId($id) {
        $this->model->getOptionsByVariantId(intval($id));
    }
    
    public function editOption($groupId, $optionId) {
        $this->model->editOption($groupId, $optionId);
    }
    
    public function saveOption($groupId, $optionId) {
        $this->model->saveOption($groupId, $optionId);
    }
}
