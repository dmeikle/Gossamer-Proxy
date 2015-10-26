<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\messaging\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\messaging\form\MessageBuilder;

/**
 * Description of MessagesController
 *
 * @author Dave Meikle
 */
class MessagesController extends AbstractController {

    public function search() {
        $result = $this->model->search();

        $this->render($result);
    }

    public function create($claimId, $locationId, $discussionId) {
        $result = $this->model->create($claimId, $locationId, $discussionId);

        $this->render($result);
    }

    public function listallByClaim($claimId, $locationId) {
        $result = $this->model->listallByClaim($claimId, $locationId);

        $this->render($result);
    }

    public function listallByDiscussion($discussionId, $offset = 0, $limit = 20) {

        $params = array('');
        $result = $this->model->listallWithParams($offset, $limit, $params);

        $this->render($result);
    }

    public function listallByLoggedInUser($offset = 0, $limit = 20, $column = 'id', $direction = 'DESC') {

        $params = array(
            'toStaff_id' => $this->getLoggedInUser()->getId(),
            'directive::OFFSET' => $offset,
            'directive::LIMIT' => $limit,
            'column' => $column,
            'direction' => $direction
        );
        $result = $this->model->listallWithParams($offset, $limit, $params);

        $this->render($result);
    }

    public function viewSelectedMessage($messageId) {


        $result['form'] = $this->drawForm($this->model, array('uniqueId' => $messageId));
        $result['uniqueId'] = $messageId;

        $this->render($result);
    }

    public function loadMessage($messageId) {
        $params = array(
            'toStaff_id' => $this->getLoggedInUser()->getId(),
            'uniqueId' => ($messageId),
            'viewmessage' => 'true'
        );

        $result = $this->model->get($params);

        $this->render($result);
    }

    public function setMessageViewed($messageId) {

        $this->model->setMessageViewed($messageId);

        $this->render(array('success' => 'true'));
    }

    public function displayInput() {
        $this->render(array('form' => $this->drawForm($this->model, array('uniqueId' => ''))));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $messageBuilder = new MessageBuilder();

        return $messageBuilder->buildForm($builder, $values);
    }

    public function getFolderCounts() {
        $params = array(
            'toStaff_id' => $this->getLoggedInUser()->getId()
        );

        $result = $this->model->getFolderCounts($params);

        $this->render($result);
    }

    public function sendNewMessage() {

        $this->model->save(0);

        $this->render(array('success' => 'true'));
    }

}
