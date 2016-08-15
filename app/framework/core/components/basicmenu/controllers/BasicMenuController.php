<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\basicmenu\controllers;

use core\AbstractController;

/**
 * BasicMenuController
 *
 * @author Dave Meikle
 */
class BasicMenuController extends AbstractController {

    /**
     * this method is initially written to display a menu for logged in
     * users. If you want to have a method for everyone..*coff coff*.. write
     * another one...
     */
    public function view() {

        $result = $this->model->view();

        $this->render(array('navigation' => $result));
    }

}
