<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\render\serialization;

use core\serialization\Serializer;

/**
 * DependencySerializer
 *
 * @author Dave Meikle
 */
class DependencySerializer extends Serializer {

    public function formatSelectionBox($id, $value, array $options, $selectedId = null) {

        $retval = '';
        foreach ($options as $option) {

            if (!array_key_exists($id, $option)) {
                throw new \Exception("key $id not found in result - check dependency configuration");
            } elseif (!array_key_exists($value, $option)) {
                throw new \Exception("value $value not found in result - check dependency configuration");
            }


            $retval .= '<option value="' . $option[$id] . '"';
            if (!is_null($selectedId) && $selectedId == $option[$id]) {
                $retval .= ' selected';
            }
            unset($option['id']);
            foreach ($option as $key => $val) {

                $retval .= " data-$key='$val'";
            }
            $retval .= '">' . $option[$value] . '</option>';
        }

        return $retval;
    }

}
