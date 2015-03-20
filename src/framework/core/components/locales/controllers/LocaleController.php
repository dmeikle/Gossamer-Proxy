<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\locales\controllers;

use core\AbstractController;

/**
 * controller for locales
 * 
 * @author Dave Meikle
 */
class LocaleController extends AbstractController {

    /**
     * change a locale from one language to another
     */
    public function change() {
        
        $params = $this->httpRequest->getPost();       
        
        $this->model->change($params['locale']);
        $uri = $this->model->getHttpRequest()->getAttribute('HTTP_REFERER');

        $this->redirect(($uri));
    }

    /**
     * save a locale's info to the database
     * 
     * @param int $id
     */
    public function save($id) {

        $result = $this->model->save(intval($id));


        $this->render($result);
    }

}
