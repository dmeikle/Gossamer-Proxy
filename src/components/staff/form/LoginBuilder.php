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
class LoginBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {
//        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $builder->addValidationResults($validationResults);
        $builder->add('email', 'text', array('class' => 'form-control'))
                ->add('username', 'text', array('class' => 'form-control'))
                ->add('password', 'password', array('class' => 'form-control'))
                ->add('submit', 'submit', array('value' => 'LOGIN_SIGNIN', 'class' => 'btn btn-primary'));

        return $builder->getForm();
    }

}
