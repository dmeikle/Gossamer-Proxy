<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\inventory\form;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;

/**
 * DepartmentBuilder
 *
 * @author Dave Meikle
 */
class VariantGroupBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Department', $validationResults)) {
            $builder->addValidationResults($validationResults['Department']);
        }

        $builder->add('groupName', 'text', array('class' => 'form-control', 'ng-model' => 'variantGroup.locale.%LOCALE%.name', 'value' => $this->buildLocaleValuesArray('variantGroup', $values, $options['locales'])), $options['locales'])
            //   ->add('locale', 'hidden', array('ng-init' => "selectedLocale = "))
              ->add('groupCode', 'text', array('class' => 'form-control', 'ng-model' => 'variantGroup.groupCode'));

        return $builder->getForm();
    }

}
