<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\tabbedview\controllers;

use core\AbstractController;

/**
 * controller for tabbed view
 * 
 * @author Dave Meikle
 */
class TabbedViewController extends AbstractController {

    /**
     * change a view from tabbed to standard html and back
     */
    public function change() {
        
        $params = $this->httpRequest->getPost();       
        //serialize preferences
        $this->model->change($params['view']);
        
        if($params['view'] == 'tabbed') {
            $this->redirect('/admin/home/tabbed');
        } else {
            $this->redirect('/admin/home');
        }
    }
}
