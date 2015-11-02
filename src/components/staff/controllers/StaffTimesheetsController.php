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

class StaffTimesheetsController extends AbstractController {

    public function listAllByStaff() {
        $offset = 0;
        $limit = 100;
        $params = array('Staff_id' => $this->getLoggedInUser()->getId());

        $result = $this->model->listAllWithParams($offset, $limit, $params, 'listByStaffId');

        $this->render($result);
    }

    public function listAllByDate($date) {
        $offset = 0;
        $limit = 100;
        $params = array('Staff_id' => $this->getLoggedInUser()->getId(),
            'date' => date("Y-m-d", strtotime($date))
        );

        $result = $this->model->listAllWithParams($offset, $limit, $params, 'get');

        $this->render($result);
    }

    public function save($staffId) {
        $result = $this->model->save($this->getLoggedInUser()->getId());

        $this->render($result);
    }

}
