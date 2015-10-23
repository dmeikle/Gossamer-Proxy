<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\incidents\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * Description of SectionBuilder
 *
 * @author Dave Meikle
 */
class SectionBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        if (is_array($validationResults) && array_key_exists('Incident', $validationResults)) {
            $builder->addValidationResults($validationResults['Incident']);
        }

        $builder->add('section', 'text', array('class' => 'form-control', $this->getValue('section', $values)))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));


        return $builder->getForm();
    }

}
