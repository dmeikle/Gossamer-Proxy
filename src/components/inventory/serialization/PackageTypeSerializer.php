<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace components\inventory\serialization;

use core\serialization\Serializer;

/**
 * PackageTypeSerializer
 *
 * @author Dave Meikle
 */
class PackageTypeSerializer extends Serializer {
    
    public function formatTypesList(array $list, $values = array()) {
        $retval = '';
      
        if(!is_array($list) || count($list) == 0) {
            return array();
        }
   
        foreach($list as $row) {
            $retval .= '<option value="' . $row['PackageTypes_id'] . '"';
            if(is_array($values) && array_key_exists('PackageTypes_id', $values) && $row['PackageTypes_id'] == $values['PackageTypes_id']) {
                $retval .= ' selected';
            }
            $retval .= '>' . $row['name'] . '</option>';
        }
    
        return $retval;
    }
}
