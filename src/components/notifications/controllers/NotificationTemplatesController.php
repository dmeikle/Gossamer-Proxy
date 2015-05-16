<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\notifications\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\notifications\form\NotificationTemplateBuilder;

/**
 * Description of NotificationsController
 *
 * @author Dave Meikle
 */
class NotificationTemplatesController extends AbstractController{
 
    public function edit($id) {
        $result = $this->model->edit(intval($id));
        
        $this->render(array('form' => $this->drawForm($this->model, $result)));
    }
    
    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $validationResults = $this->httpRequest->getAttribute('ERROR_RESULT');       
        $builder->addValidationResults($validationResults);
        
        $templateBuilder = new NotificationTemplateBuilder();        
        
        $messagingTypes = $this->httpRequest->getAttribute('MessagingTypes');
        $serializer = new \components\notifications\serialization\MessagingTypeSerializer();
        $options = array(
            'messagingTypes' => $serializer->formatSelectionList($messagingTypes, $values)
        );
        
        return $templateBuilder->buildForm($builder, $values,$options, $validationResults);
    }
    
    public function save($id) {
        parent::saveAndRedirect($id, 'super_notifications_templates_list', array(0,20));
    }
}
