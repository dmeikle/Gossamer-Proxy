<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contacts\form;

use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * Description of ContactDisplayBuilder
 *
 * @author Dave Meikle
 */
class ContactDisplayBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        $builder->add('Companies_id', 'span', array('class' => 'textboxAsLabel'))
                ->add('ContactTypes_id', 'span', array('class' => 'textboxAsLabel'))
                ->add('firstname', 'span', array('readonly' => 'true', 'class' => 'textboxAsLabel', $this->getValue('firstname', $values)))
                ->add('lastname', 'span', array('readonly' => 'true', 'class' => 'textboxAsLabel', $this->getValue('lastname', $values)))
                ->add('email', 'span', array('readonly' => 'true', 'class' => 'textboxAsLabel', $this->getValue('email', $values)))
                ->add('mobile', 'span', array('readonly' => 'true', 'class' => 'textboxAsLabel', $this->getValue('mobile', $values)))
                ->add('home', 'span', array('readonly' => 'true', 'class' => 'textboxAsLabel', $this->getValue('home', $values)))
                ->add('office', 'span', array('readonly' => 'true', 'class' => 'textboxAsLabel'))
                ->add('extension', 'span', array('readonly' => 'true', 'class' => 'textboxAsLabel', $this->getValue('extension', $values)))
                ->add('isActive', 'span', array('readonly' => 'true', 'class' => 'textboxAsLabel', $this->getValue('isActive', $values)))
                ->add('span', 'text', array('readonly' => 'true', 'class' => 'textboxAsLabel', $this->getValue('ContactInvites_id', $values)))
                ->add('notes', 'span', array('readonly' => 'true', 'class' => 'textboxAsLabel', $this->getValue('notes', $values)));

        return $builder->getForm();
    }

}
