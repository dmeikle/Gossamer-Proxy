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

        $builder->add('baseboard', 'text', array('ng-model' => 'item.baseboard.quantity', 'class' => 'form-control'))
                ->add('casing', 'text', array('ng-model' => 'item.casing.quantity', 'class' => 'form-control'))
                ->add('cornerBead', 'text', array('ng-model' => 'item.cornerBead.quantity', 'class' => 'form-control'))
                ->add('cove', 'text', array('ng-model' => 'item.cove.quantity', 'class' => 'form-control'))
                ->add('drywall12', 'text', array('ng-model' => 'item.drywall12.quantity', 'class' => 'form-control'))
                ->add('drywall58', 'text', array('ng-model' => 'item.drywall58.quantity', 'class' => 'form-control'))
                ->add('insulation', 'text', array('ng-model' => 'item.insulation.quantity', 'class' => 'form-control'))
                ->add('jBead', 'text', array('ng-model' => 'item.jBead.quantity', 'class' => 'form-control'))
                ->add('other', 'text', array('ng-model' => 'item.other.quantity', 'class' => 'form-control'))
                ->add('vapourBarrier', 'text', array('ng-model' => 'item.vapourBarrier.quantity', 'class' => 'form-control'));

        if (array_key_exists('Claims_id', $options)) {
            $builder->add('Claims_id', 'hidden', array('class' => 'form-control', 'value' => $this->getValue('Claims_id', $values)));
        }

        return $builder->getForm();
    }

}
