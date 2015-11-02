<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\tickets\forms;

use Gossamer\CMS\Forms\AbstractBuilder;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\Factory\ControlFactory;

/**
 * Description of TicketBuilder
 *
 * @author Dave Meikle
 */
class TicketAssigneeBuilder extends AbstractBuilder {

    public function buildForm(FormBuilder $builder, array $values = null, array $options = null, array $validationResults = null) {

        if (is_array($validationResults) && array_key_exists('Staff', $validationResults)) {
            $builder->addValidationResults($validationResults['Staff']);
        }

        $builder->add('Tickets_id', ControlFactory::HIDDEN, array('value' => $this->getValue('Tickets_id', $values)))
                ->add('Staff_id', ControlFactory::HIDDEN, array('value' => $this->getValue('Staff_id', $values)))
                ->add('comments', ControlFactory::TEXTAREA, array('class' => 'form-control', 'value' => $this->getValue('comments', $values)))
                ->add('isActive', 'check', array('class' => 'form-control', 'value' => '1', 'checked' => ($this->getValue('isActive', $values) == 1 ? 'true' : '')))
                ->add('submit', 'submit', array('value' => 'Next', 'class' => 'btn btn-lg btn-primary'));

        return $builder->getForm();
    }

}
