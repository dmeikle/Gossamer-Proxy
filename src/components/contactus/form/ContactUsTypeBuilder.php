<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contactus\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * Description of ContactUsBuilder
 *
 * @author Dave Meikle
 */
class ContactUsTypeBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('ContactUs', $validationResults)) {
            $builder->addValidationResults($validationResults['ContactUs']);
        }
        // pr($this->getValue('ContactUsTypes', $options));
        $builder->add('type', 'text', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('type', $values, $options['locales'])), $options['locales'])
                ->add('submit', 'submit', array('class' => 'btn btn-primary', 'value' => 'Save'));


        return $builder->getForm();
    }

//put your code here
}
