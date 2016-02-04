<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\scoping\controllers;

use core\AbstractController;

/**
 * ScopesController
 *
 * @author Dave Meikle
 */
class ScopesController extends AbstractController {

    public function listall($offset = 0, $limit = 20) {
        $locale = $this->getDefaultLocale();
        $params = array(
            'locale' => $locale['locale'],
            'directive::DIRECTION' => 'desc'
        );

        $result = $this->model->listAllWithParams(intval($offset), intval($limit), 'list', $params);
    }

}
