<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\form;

use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * Description of StaffRoleBuilder
 *
 * @author Dave Meikle
 */
class StaffRoleBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        $retval = array();
        if (is_array($validationResults) && array_key_exists('StaffRole', $validationResults)) {
            $builder->addValidationResults($validationResults['StaffRole']);
        }

        foreach ($values as $row) {
            $tmpBuilder = clone $builder;
            $tmpBuilder->add($row['id'], 'check', array('ng-model' => 'ctrl.staffRoles.' . $row['role']));
            $html = $tmpBuilder->getForm();
            $row['html'] = current($html);
            $retval[] = $row;
        }


        return $retval;
    }

}
