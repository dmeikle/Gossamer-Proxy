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
 * VendorItemBuilder
 *
 * @author Dave Meikle
 */
class VendorItemBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('VendorItem', $validationResults)) {
            $builder->addValidationResults($validationResults['VendorItem']);
        }

        $builder->add('id', 'hidden', array('value' => $this->getValue('id', $values)))
                ->add('Vendors_id', 'hidden', array('class' => 'form-control', 'value' => $this->getValue('Vendors_id', $values)))
                ->add('leadTime', 'text', array('class' => 'form-control', 'value' => $this->getValue('leadTime', $values)))
                ->add('InventoryItems_id', 'hidden', array('value' => $this->getValue('InventoryItems_id', $values)))
                ->add('price', 'text', array('class' => 'form-control', 'value' => $this->getValue('price', $values)))
                ->add('minOrderQuantity', 'text', array('class' => 'form-control', 'value' => $this->getValue('minOrderQuantity', $values)))
        ;

        if (array_key_exists('packageTypes', $options)) {
            $builder->add('PackageTypes_id', 'select', array('class' => 'form-control', 'options' => $options['packageTypes']));
        }

        return $builder->getForm();
    }

}
