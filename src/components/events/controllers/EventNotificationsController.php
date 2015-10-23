<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\events\controllers;

use core\AbstractController;
use components\events\form\ContactBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use core\navigation\Pagination;

class EventNotificationsController extends AbstractController {

    public function edit($id) {
        $result = $this->model->edit($id);

        // $this->render(array('form' => $this->drawForm($this->model, $result)));
        $this->render($result);
    }

    public function listAllByEventId($id, $offset, $limit) {
        $result = $this->model->listAllByEventId($id, $offset, $limit);
        $result['Event'] = $this->httpRequest->getAttribute('Event');

        $pagination = new Pagination($this->logger);
        $result['pagination'] = $pagination->paginate($result['EventAttendeesCount'], $offset, $limit, '/admin/events/eventattendees');
        unset($pagination);
        if (!array_key_exists('EventAttendees', $result)) {
            $result['EventAttendees'] = array();
        }
        $this->render($result);
    }

    public function save($id) {
        parent::saveAndRedirect($id, 'admin_event_contacts_list', array(0, 20));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $builder = new ContactBuilder();
        $builder->setLocales($this->httpRequest->getAttribute('locales'));

        $options = array();

        return $builder->buildForm($formBuilder, $values, $options, $results);
    }

}
