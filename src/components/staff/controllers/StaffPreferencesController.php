<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\controllers;

use core\AbstractController;

/**
 * StaffPreferencesController
 *
 * @author Dave Meikle
 */
class StaffPreferencesController extends AbstractController {

    public function saveHomePage() {
        $params = array(
            'Staff_id' => $this->getLoggedInUser()->getId(),
            'homePage' => $this->getRequestUri()
        );

        $this->model->savePreferences($params);

        $this->render(array('success' => true));
    }

    private function getRequestUri() {
        $fullUrl = $this->httpRequest->getAttribute('HTTP_REFERER');

        $fullUrl = str_replace('http://', '', $fullUrl);
        $fullUrl = str_replace('https//', '', $fullUrl);

        $pieces = explode('/', $fullUrl);
        //lose the domain name
        array_shift($pieces);

        return '/' . implode('/', $pieces);
    }

}
