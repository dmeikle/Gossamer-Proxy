<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * Description of Cost Card Builder
 *
 * @author Dave Meikle
 */
class CostCardBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Claim', $validationResults)) {
            $builder->addValidationResults($validationResults['Claim']);
        }

        $builder->add('ClaimPhases_id', 'select', array('class' => 'form-control', 'options' => $options['claimPhases'], 'ng-model' => 'item.ClaimPhases_id'))
                ->add('notes', 'textarea', array('class' => 'form-control', 'ng-model' => 'item.notes'));
        return $builder->getForm();
    }

}
