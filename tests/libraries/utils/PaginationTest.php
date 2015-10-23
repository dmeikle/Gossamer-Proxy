<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace tests\libraries\utils;

use tests\TestCaseLogger;
use libraries\utils\Pagination;

/**
 * Description of PaginationTest
 *
 * @author Dave Meikle
 */
class PaginationTest extends TestCaseLogger {

    public function testGetPagination() {
        $pagination = new Pagination($this->logger);

        $rowCount = 100;
        $offset = 10;
        $limit = 10;
        $pagination->getPagination($rowCount, $offset, $limit);
    }

}
