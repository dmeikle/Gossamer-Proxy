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
 * InventoryEquipmentTypeSerializer
 *
 * @author Dave Meikle
 */
class InventoryEquipmentTypeSerializer extends Serializer {

    public function formatTypesList(array $list, $values = array()) {
        $retval = '';

        
        if (!is_array($list) || count($list) == 0) {
            return array();
        }

        foreach ($list as $row) {
            $retval .= '<option value="' . $row['InventoryEquipmentTypes_id'] . '"';
            if (is_array($values) && array_key_exists('InventoryEquipmentTypes_id', $values) && $row['InventoryEquipmentTypes_id'] == $values['InventoryEquipmentTypes_id']) {
                $retval .= ' selected';
            }
            $retval .= '>' . $row['type'] . '</option>';
        }

        return $retval;
    }

}
