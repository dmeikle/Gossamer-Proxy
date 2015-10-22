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
 * Description of StaffBuilder
 *
 * @author Dave Meikle
 */
class StaffAuthorizationBuilder extends AbstractBuilder{


    public function buildCredentialsForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('StaffAuthorization', $validationResults)) {
            $builder->addValidationResults($validationResults['StaffAuthorization']);
        }

        $builder->add('username', 'text', array('ng-model' => 'authorization.username','ng-model-options'=> '{debounce:500}','check-username-exists'=>'', 'ng-focus' => 'clearErrors()', 'class' => 'form-control', 'value' => $this->getValue('username', $values)))
                ->add('password', 'password', array('ng-disabled' => 'authorization.emailUser','ng-model' => 'authorization.password','class' => 'form-control'))
                ->add('passwordConfirm', 'password', array('ng-disabled' => 'authorization.emailUser','ng-model' => 'authorization.passwordConfirm','class' => 'form-control'))
                ->add('cancel', 'button', array('value' => 'Cancel', 'class' => 'btn btn-lg'))
                ->add('saveCredentials', 'button', array('value' => 'Next', 'class' => 'btn btn-primary save-staff', 'ng-click' => 'saveCredentials(authorization)'));

        return $builder->getForm();
    }

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
        return $this->buildCredentialsForm($builder, $values, $options, $validationResults);
    }

    public function buildPermissionsForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if(is_array($validationResults) && array_key_exists('StaffAuthorization', $validationResults)) {
            $builder->addValidationResults($validationResults['StaffAuthorization']);
        }

        //$builder->add('username', 'text', array('class' => 'form-control', $this->getValue('username', $values)))
        //        ->add('password', 'password', array('class' => 'form-control'))
         //       ->add('passwordConfirm', 'password', array('class' => 'form-control'))
         $builder->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));

        return $builder->getForm();
    }

//
//    public function ajaxEdit($id) {
//        $result = $this->model->edit(intval($id));
//        unset($result['emergencyContacts']);
//
//        $this->render(array('Staff' => $result));
//    }

}
