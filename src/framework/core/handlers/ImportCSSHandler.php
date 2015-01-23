<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\handlers;

use core\handlers\BaseHandler;

class ImportCSSHandler extends BaseHandler
{
    public function handleRequest($params = array()) {
        $retval = array();
        //check to see if there are any escaped rows then import them
        foreach($params as $row) {
            $tmp = trim($row);

            if(substr($tmp,0,11) == '@components') {

                $filepath = str_replace('@components','',$tmp);

                //we need to import this if it doesn't exist or if the existing is stale
                if($this->checkFileIsStale($filepath, 'css')) {
                    $this->copyFile($filepath, 'css');
                }

                $retval[] = '/css/components' . str_replace('includes/css/', '', $filepath);
            } elseif(strlen($tmp > 5)) {//abitrary length just to show we hold something greater than whitespace
                $retval[] = $tmp;
            }
        }

        return array_filter($retval);
    }


}