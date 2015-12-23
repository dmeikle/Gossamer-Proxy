<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\scoping\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * Description of MaterialTakeOffBuilder
 *
 * @author Dave Meikle
 */
class MaterialTakeOffBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('MaterialTakeOff', $validationResults)) {
            $builder->addValidationResults($validationResults['MaterialTakeOff']);
        }

        $builder->add('baseboard', 'text', array('ng-model' => 'item.baseboard', 'class' => 'form-control'))
                ->add('casing', 'text', array('ng-model' => 'item.casing', 'class' => 'form-control'))
                ->add('cornerBead', 'text', array('ng-model' => 'item.cornerBead', 'class' => 'form-control'))
                ->add('cove', 'text', array('ng-model' => 'item.cove', 'class' => 'form-control'))
                ->add('drywall', 'text', array('ng-model' => 'item.drywall', 'class' => 'form-control'))
                ->add('insulation', 'text', array('ng-model' => 'item.insulation', 'class' => 'form-control'))
                ->add('jBead', 'text', array('ng-model' => 'item.jBead', 'class' => 'form-control'))
                ->add('other', 'text', array('ng-model' => 'item.other', 'class' => 'form-control'))
                ->add('vapourBarrier', 'text', array('ng-model' => 'item.vapourBarrier', 'class' => 'form-control'));

        if (array_key_exists('Claims_id', $options)) {
            $builder->add('Claims_id', 'hidden', array('class' => 'form-control', 'value' => $this->getValue('Claims_id', $values)));
        }

        return $builder->getForm();
    }

}
