<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\customers\serialization;

use core\serialization\Serializer;

/**
 * Description of CustomerTypeSerializer
 *
 * @author Dave Meikle
 */
class CustomerTypeSerializer extends Serializer{
    
    public function formatCustomerTypesList(array $list, $values = array()) {
        $retval = '';
       
        if(!is_array($list) || count($list) == 0) {
            return array();
        }
       
        foreach($list as $row) {
            $retval .= '<option value="' . $row['CustomerTypes_id'] . '"';
            if(array_key_exists('CustomerTypes_id', $values) && $row['CustomerTypes_id'] == $values['CustomerTypes_id']) {
                $retval .= ' selected';
            }
            $retval .= '>' . $row['contactType'] . '</option>';
        }
      
        return $retval;
    }
}
