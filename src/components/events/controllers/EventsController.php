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
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\events\form\EventBuilder;
use components\events\serialization\EventContactSerializer;
use components\events\serialization\EventLocationSerializer;
use components\events\serialization\EventTypeSerializer;
use core\navigation\Pagination;
use core\eventlisteners\Event;

class EventsController extends AbstractController {

    public function edit($id) {
        $result = $this->model->edit($id);

        $this->render(array('locales' => $this->httpRequest->getAttribute('locales'), 'form' => $this->drawForm($this->model, $result)));
    }

    public function save($id) {
        parent::saveAndRedirect($id, 'admin_events_list', array(0, 20));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $builder = new EventBuilder();
        $builder->setLocales($this->httpRequest->getAttribute('locales'));

        $options = array(
            'locales' => $this->httpRequest->getAttribute('locales')
        );

        $eventContactSerializer = new EventContactSerializer();
        $options['EventContacts'] = $eventContactSerializer->formatSelectionBoxOptions($this->httpRequest->getAttribute('EventContacts'), array($values['EventContacts_id']), 'name');
        unset($eventContactSerializer);

        $eventLocationSerializer = new EventLocationSerializer();
        $options['EventLocations'] = $eventLocationSerializer->formatSelectionBoxOptions($this->httpRequest->getAttribute('EventLocations'), array($values['EventLocations_id']), 'name');
        unset($eventLocationSerializer);

        $eventTypeSerializer = new EventTypeSerializer();
        $options['EventTypes'] = $eventTypeSerializer->formatSelectionBoxOptions($this->httpRequest->getAttribute('EventTypes'), array($values['EventTypes_id']), 'type');
        unset($eventTypeSerializer);

        return $builder->buildForm($formBuilder, $values, $options, $results);
    }

    public function listall($offset = 0, $limit = 0) {
        $result = $this->model->listall($offset, $limit);

        $pagination = new Pagination($this->logger);
        $result['pagination'] = $pagination->paginate($result['EventsCount'], $offset, $limit, '/admin/events/events');
        unset($pagination);

        $this->render($result);
    }

    public function listallByContact($offset = 0, $limit = 0) {
        $params = array('Contacts_id' => $this->getLoggedInUser()->getId());
        $result = $this->model->listallWithParams($offset, $limit, $params, 'listByContact');

        $pagination = new Pagination($this->logger);
        $result['pagination'] = $pagination->paginate($result['EventsCount'], $offset, $limit, '/admin/events/events');
        unset($pagination);

        $this->render($result);
    }

    public function view($id) {
        $result = $this->model->edit($id);

        $event = new Event('event_loaded', $result);
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'event_loaded', $event);

        $this->render(array('event' => $result, 'location' => current($this->httpRequest->getAttribute('EventLocation'))));
    }

}
