<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\surveys\serialization;

use core\serialization\Serializer;

/**
 * Description of QuestionSerializer
 *
 * @author Dave Meikle
 */
class QuestionSerializer extends Serializer {

    public function formatSearchResults(array $results) {
        $retval = array();

        foreach ($results as $row) {
            $retval[] = array(
                'id' => $row['id'],
                'label' => $row['question'],
                'value' => '<b>' . $row['question'] . "</b><br />"
            );
        }

        return $retval;
    }

}
