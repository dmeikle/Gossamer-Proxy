<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\widgets\serialization;

use core\serialization\Serializer;

/**
 * WidgetPageWidgetsSerializer
 *
 * @author Dave Meikle
 */
class WidgetPageWidgetsSerializer extends Serializer {

    public function formatResults(array $result) {

        $retval = array();
        $lastSection = '';
        foreach ($result['PageWidgets'] as $row) {
            if ($lastSection != $row['sectionName']) {
                $lastSection = $row['sectionName'];
                unset($row['sectionName']);
            }
            unset($row['ymlKey']);
            $key = $row['htmlKey'];
            unset($row['htmlKey']);

            $retval[$lastSection][$key] = $row;
        }

        return $retval;
    }

}
