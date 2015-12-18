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
 * Description of InventoryEquipmentTransferBuilder
 *
 * @author Dave Meikle
 */
class InventoryEquipmentTransferBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        
        if (is_array($validationResults) && array_key_exists('Claim', $validationResults)) {
            $builder->addValidationResults($validationResults['Claim']);
        }

        if (array_key_exists('vehicles', $options)) {
            // $builder->add('Vehicles_id', 'select', array('ng-model' => 'transfer.Vehicles_id', 'ng-disabled' => "vehicleTransferBy != 'Vehicles_id' || cageTransferBy != 'Vehicles_id'", 'class' => 'form-control', 'options' => $options['vehicles']));
        }   $builder->add('Vehicles_id', 'select', array('ng-model' => 'transfer.Vehicles_id', 'class' => 'form-control', 'options' => $options['vehicles']));
        if (array_key_exists('warehouseLocations', $options)) {
            // $builder->add('WarehouseLocations_id', 'select', array('ng-model' => 'transfer.WarehouseLocations_id', 'ng-disabled' => 'vehicleTransferBy != \'WarehouseLocations_id\'', 'class' => 'form-control', 'options' => $options['warehouseLocations']));
            $builder->add('WarehouseLocations_id', 'select', array('ng-model' => 'transfer.WarehouseLocations_id', 'class' => 'form-control', 'options' => $options['warehouseLocations']));
        }






        return $builder->getForm();
    }

}
