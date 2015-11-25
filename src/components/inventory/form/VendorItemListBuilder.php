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
 * VendorItemListBuilder
 *
 * @author Dave Meikle
 */
class VendorItemListBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('VendorItem', $validationResults)) {
            $builder->addValidationResults($validationResults['VendorItem']);
        }
//changed model.item to model.item to prevent collisions with inventory for on edit inventory page
        $builder->add('price', 'text', array('ng-model' => 'item.price', 'class' => 'form-control'))
                ->add('vendorPrice', 'text', array('ng-model' => 'item.vendorPrice', 'class' => 'form-control'))

        ;

        if (array_key_exists('packageTypes', $options)) {
            $builder->add('PackageTypes_id', 'select', array('class' => 'form-control', 'options' => $options['packageTypes']));
        }

        return $builder->getForm();
    }

}
