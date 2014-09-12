<?php

namespace libraries\utils;

use Monolog\Logger;

class Pagination
{
    private $logger;
    
    private $rowCount;
    
    private $offset;
    
    private $limit;
    
    
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }
   
    public function getPagination($rowCount, $offset, $limit) {
        $this->rowCount = $rowCount;
        $this->offset = $offset;
        $this->limit = $limit;
        $retval = array();
        $numPages = $this->getNumPages();
        $currentEstablished = false;
     
        for($i = 0; $i < $this->getNumPages(); $i++) {
            $dataOffset = ($i * $limit);
            $item = array('data-offset' => $dataOffset, 'data-limit' => $limit);
            if(!$currentEstablished && $offset <= $dataOffset) {
                $item['current'] = 'current';
                $currentEstablished = true;
            } else {
                $item['current'] = '';
            }
            $retval[] = $item;
        }
        
        return $retval;
    }
    
    private function getNumPages() {
        return $this->rowCount / $this->limit;
    }
    
}
