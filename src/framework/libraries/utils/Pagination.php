<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace libraries\utils;

use Monolog\Logger;

/**
 * creates the pagination links to be used at the bottom of a list
 *
 * @author Dave Meikle
 */
class Pagination {

    private $logger;
    private $rowCount;
    private $offset;
    private $limit;

    /**
     *
     * @param Logger $logger
     */
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    /**
     *
     * @param int $rowCount
     * @param int $offset
     * @param int $limit
     * @return string
     */
    public function getPagination($rowCount, $offset, $limit) {

        $this->rowCount = $rowCount;
        $this->offset = $offset;
        $this->limit = $limit;
        $retval = array();
        $numPages = $this->getNumPages();
        $currentEstablished = false;

        for ($i = 0; $i < $this->getNumPages(); $i++) {
            $dataOffset = ($i * $limit);
            $item = array('data-offset' => $dataOffset, 'data-limit' => $limit);
            if (!$currentEstablished && $offset <= $dataOffset) {
                $item['current'] = 'current';
                $currentEstablished = true;
            } else {
                $item['current'] = '';
            }
            $retval[] = $item;
        }

        return $retval;
    }

    /**
     *
     * @return int
     */
    private function getNumPages() {
        return $this->rowCount / $this->limit;
    }

}
