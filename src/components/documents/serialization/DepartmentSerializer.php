<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\departments\serialization;

use core\serialization\Serializer;

/**
 * DepartmentSerialization
 *
 * @author Dave Meikle
 */
class DepartmentSerializer extends Serializer {

    public function pruneList(array $list = null) {
        if (is_null($list)) {
            return '';
        }

        $retval = array();

        foreach ($list as $row) {

            $retval[$row['id']] = $row['name'];
        }

        return $retval;
    }

}
