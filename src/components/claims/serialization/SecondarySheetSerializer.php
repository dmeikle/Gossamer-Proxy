<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\serialization;

use core\serialization\Serializer;

/**
 * SecondarySheetSerializer
 *
 * @author Dave Meikle
 */
class SecondarySheetSerializer extends Serializer {

    public function serializeQuestions(array $results) {

        if (!array_key_exists('Actions', $results)) {
            return array();
        }
        $retval = array();

        foreach ($results['Actions'] as $action) {
            $retval[$action['keyName']][$action['groupId']][] = $action;
        }

        return $retval;
    }

}
