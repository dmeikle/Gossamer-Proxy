<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\navigation;

use Monolog\Logger;

/**
 * Used to create the pagination results at the bottom of a list
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
     * returns the array of pagination values
     * 
     * @param int $rowCount
     * @param int $offset
     * @param int $limit
     * 
     * @return array
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
     * determines the number of pages
     * 
     * @return int
     */
    private function getNumPages() {

        return $this->rowCount / $this->limit;
    }

    /**
     * creates the HTML to draw to the page
     * 
     * @param array $rowCount
     * @param int $offset
     * @param int $limit
     * @param string $uriPrefix - the value of the URI to put into the link
     * 
     * @return string
     */
    public function paginate(array $rowCount, $offset, $limit, $uriPrefix) {
        if (is_array($rowCount)) {
            $rowCount = $rowCount[0]['rowCount'];
        }

        $pagination = $this->getPagination($rowCount, $offset, $limit);

        return $this->getHtml($pagination, $uriPrefix);
    }

    /**
     * draws the HTML we are placing into the page
     * 
     * @param tyarraype $pagination
     * @param string $uriPrefix
     * 
     * @return string
     */
    private function getHtml($pagination, $uriPrefix) {

        $firstPagination = current($pagination);
        $lastPagination = end($pagination);
        $retval = '<div>
            <select id="resultsPerPage">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>    
            </select>
            <ul class="pagination">';
        $retval .= '<li><a class="pagination ' . $firstPagination['current'] . '" data-url="' . $uriPrefix . '" data-offset="' . $firstPagination['data-offset'] .
                '" data-limit="' . $firstPagination['data-limit'] . '">&laquo;</a></li>';
        foreach ($pagination as $index => $page) {

            $pageval = ' <li><a class="pagination ' . $page['current'] . '" data-url="' . $uriPrefix . '" data-offset="' . $page['data-offset'] .
                    '" data-limit="' . $page['data-limit'] . '" >' . ($index + 1) . '</a></li>';

            $retval .= $pageval;
        }

        $retval .= ' <li><a class="pagination ' . $lastPagination['current'] . '" data-url="' . $uriPrefix . '" data-offset="' . $lastPagination['data-offset'] .
                '" data-limit="' . $lastPagination['data-limit'] . '" >&raquo;</a></li></ul></div>';

        return $retval;
    }

}
