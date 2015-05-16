<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace components\twitter\serialization;

use core\serialization\Serializer;
/**
 * TicketCategorySerializer
 *
 * @author Dave Meikle
 */
class TwitterSerializer extends Serializer {
    
    public function formatResults(array $result = null) {
        if(is_null($result)) {
            return array();
        }
        $retval = array();
     
        foreach($result as $value) {
          
            if(!array_key_exists('created_at', $value)) {
                continue;
            }
            $date = strtotime($value['created_at']);
            
            $tmp['date'] = date("F j \<\b\\r\>h:iA", $date);
            $tmp['subject'] = $value['text'];
            $retval[] = $tmp;
        }
        
        return $retval;
    }
}
