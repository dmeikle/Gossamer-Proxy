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
use core\navigation\Pagination;

/**
 * Description of InventoryController
 *
 * @author Dave Meikle
 */
class InventoryController extends AbstractController {

    public function search() {

        $result = $this->model->search($this->httpRequest->getQueryParameters());

        $this->render($result);
    }

    public function listall($offset = 0, $limit = 20) {
//        echo('here');
        $offset = intval($offset);
        $limit = intval($limit);
        $params = $this->httpRequest->getQueryParameters();

        $this->render($this->model->listallWithParams($offset, $limit, $params, 'list'));
    }

    /**
     * listallReverse - retrieves rows based on offset, limit
     *
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listallReverse($offset = 0, $limit = 20) {

        $params = $this->httpRequest->getQueryParameters();
        $params['directive::ORDER_BY'] = 'id';
        $params['directive::DIRECTION'] = 'desc';

        $result = $this->model->listallWithParams($offset, $limit, $params, 'list');

        if (is_array($result) && array_key_exists($this->model->getEntity() . 'sCount', $result)) {
            $pagination = new Pagination($this->logger);

            //CP-33 changed to json output for new Angular based page draws
            $result['pagination'] = $pagination->getPaginationJson($result[$this->model->getEntity() . 'sCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());
            unset($pagination);
        }

        $this->render($result);
    }

}
