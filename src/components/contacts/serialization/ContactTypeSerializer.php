<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contacts\serialization;

use core\serialization\Serializer;

/**
 * Description of ContactTypeSerializer
 *
 * @author Dave Meikle
 */
class ContactTypeSerializer extends Serializer {

    public function formatContactTypesList(array $list, $values = array()) {
        $retval = '';

        if (!is_array($list) || count($list) == 0) {
            return array();
        }

        foreach ($list as $row) {
            $retval .= '<option value="' . $row['ContactTypes_id'] . '"';
            if (array_key_exists('ContactTypes_id', $values) && $row['ContactTypes_id'] == $values['ContactTypes_id']) {
                $retval .= ' selected';
            }
            $retval .= '>' . $row['contactType'] . '</option>';
        }

        return $retval;
    }

}
