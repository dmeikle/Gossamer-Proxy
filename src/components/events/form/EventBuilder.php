<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\events\form;

use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\AbstractBuilder;

/**
 * Description of StaffBuilder
 *
 * @author Dave Meikle
 */
class EventBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Event', $validationResults)) {
            $builder->addValidationResults($validationResults['Event']);
        }

        $builder->add('name', 'text', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('name', $values, $options['locales'])), $options['locales'])
                ->add('description', 'textarea', array('class' => 'form-control', 'value' => $this->buildLocaleValuesArray('description', $values, $options['locales'])), $options['locales'])
                ->add('EventTypes_id', 'select', array('class' => 'form-control', 'options' => $options['EventTypes']))
                ->add('EventLocations_id', 'select', array('class' => 'form-control', 'options' => $options['EventLocations']))
                ->add('EventContacts_id', 'select', array('class' => 'form-control', 'options' => $options['EventContacts']))
                ->add('eventDate', 'text', array('class' => 'form-control', 'value' => $this->getValue('eventDate', $values)))
                ->add('fromTime', 'text', array('class' => 'form-control', 'value' => $this->getValue('fromTime', $values)))
                ->add('toTime', 'text', array('class' => 'form-control', 'value' => $this->getValue('toTime', $values)))
                ->add('isPublic', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => $this->getValue('isPublic', $values)))
                ->add('rsvpRequired', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => $this->getValue('rsvpRequired', $values)))
                ->add('isActive', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => $this->getValue('isActive', $values)))
                ->add('cost', 'text', array('class' => 'form-control', 'value' => $this->getValue('cost', $values)))
                ->add('tags', 'text', array('class' => 'form-control', 'value' => $this->getValue('tags', $values)))
                ->add('save', 'submit', array('value' => 'Save', 'class' => 'btn btn-primary'))
                ->add('cancel', 'cancel', array('value' => 'Cancel', 'class' => 'btn btn-primary'));
        if ($this->getValue('id', $values) <> '') {
            $builder->add('contactSettings', 'button', array('value' => 'Contact Settings', 'class' => 'btn btn-primary contactSettings', 'data-id' => $this->getValue('id', $values)));
        } else {
            $builder->add('contactSettings', 'placeholder', array());
        }

        return $builder->getForm();
    }

}
