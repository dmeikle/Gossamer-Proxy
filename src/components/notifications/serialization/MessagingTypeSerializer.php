<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace components\notifications\serialization;

use core\serialization\Serializer;

/**
 * MessagingTypeSerializer
 *
 * @author Dave Meikle
 */
class MessagingTypeSerializer extends Serializer {
        
    public function formatSelectionList(array $list = null, array $values = null) {
        if(is_null($list)) {
            return '';
        }
        
        $retval = '';
        
        foreach($list as $row) {
            $retval .= '<option value="' . $row['id'] . '"';
            if(is_array($values) && array_key_exists('MessageTypes_id', $values) && $values['MessageTypes_id'] = $row['id']) {
                $retval .= ' selected';
            }
            $retval .= '>' . $row['messageType'] . '</option>';
        }
      
        return $retval;
    }
}
