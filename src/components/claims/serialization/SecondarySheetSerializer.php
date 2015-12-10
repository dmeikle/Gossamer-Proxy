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
        $section = array();
        $row = array();

        $categoryId = '';
        $category = '';
        $groupId = '';
        foreach ($results['Actions'] as $action) {
//
//            if ($groupId != $action['groupId'] && $categoryId == $action['SecondarySheetCategories_id']) {
//
//                $section[$groupId] = $row;
//                $row = array();
//                $groupId = $action['groupId'];
//            }
//
            if ($categoryId != $action['SecondarySheetCategories_id']) {

                $section[$groupId] = $row;
                $row = array();
                $groupId = $action['groupId'];

                // $retval[$category] = $section;
                $retval[$action['keyName']] = $section;
                $section = array();
                $category = $action['category'];
                $categoryId = $action['SecondarySheetCategories_id'];
            }
            unset($action['category']);
            unset($action['groupId']);
            unset($action['SecondarySheetCategories_id']);

            $row[] = $action;
//        }
        }
        //add the last iteration
        $retval['category'] = $section;

        //lost the first empty element
        array_shift($retval);

        return $retval;
    }

}
