<?php

namespace core\handlers;

use core\handlers\BaseHandler;

class ImportJSHandler extends BaseHandler
{
    public function handleRequest($params = array()) {
        $retval = array();
        //check to see if there are any escaped rows then import them
        foreach($params as $row) {
            $tmp = trim($row);

            if(substr($tmp,0,11) == '@components') {

                $filepath = str_replace('@components','',$tmp);

                //we need to import this if it doesn't exist or if the existing is stale
                if($this->checkFileIsStale($filepath, 'js')) {
                    $this->copyFile($filepath, 'js');
                }

                $retval[] = '/js/components' . str_replace('includes/js/', '', $filepath);
//            }elseif(substr($tmp,0,11) == '@app/') {
//
//                $filepath = str_replace('@','',$tmp);
//
//                //we need to import this if it doesn't exist or if the existing is stale
//                if($this->checkFileIsStale($filepath, 'js')) {
//                    $this->copyFile($filepath, 'js');
//                }
//
//                $retval[] = '/js/core/components' . str_replace('includes/js/', '', $filepath);
            } elseif(strlen($tmp > 5)) {//abitrary length just to show we hold something greater than whitespace
                $retval[] = $tmp;
            }
        }

        return array_filter($retval);
    }


}