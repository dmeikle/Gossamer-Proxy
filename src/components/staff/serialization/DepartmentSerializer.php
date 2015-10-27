<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\serialization;

use core\serialization\Serializer;

/**
 * Description of WorkPerformed
 *
 * @author Dave Meikle
 */
class DepartmentSerializer extends Serializer {

    public function formatDepartmentsArray(array $list) {
        $retval = array();
        if (!is_array($list) || count($list) == 0) {
            return array();
        }

        foreach ($list as $row) {
            if (!array_key_exists('id', $row)) {
                return array();
            }

            $retval[$row['id']] = $row['name'];
        }

        return $retval;
    }

}
