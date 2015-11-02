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
use components\events\form\EventListBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use core\navigation\Pagination;

class EventInviteListController extends AbstractController {

    public function edit($id) {
        $result = $this->model->edit($id);

        $this->render(array('form' => $this->drawForm($this->model, $result)));
    }

    public function save($id) {
        parent::saveAndRedirect($id, 'admin_eventlist_contacts_list', array(0, 20));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $builder = new EventListBuilder();
        $builder->setLocales($this->httpRequest->getAttribute('locales'));

        $options = array();

        return $builder->buildForm($formBuilder, $values, $options, $results);
    }

    public function listallByEventId($eventId, $offset, $limit) {
        $params = array('Events_id' => $eventId);
        $result = $this->model->listAllWithParams($offset, $limit, $params);

        //pagination...
        if (is_array($result) && array_key_exists('ListContactsCount', $result)) {
            $pagination = new Pagination($this->logger);
            $result['pagination'] = $pagination->paginate($result['ListContactsCount'], $offset, $limit, $this->getUriWithoutOffsetLimit());
            unset($pagination);
        }

        $this->render($result);
    }

}
