<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\tickets\controllers;

use core\AbstractController;
use Gossamer\CMS\Forms\FormBuilderInterface;
use Gossamer\CMS\Forms\FormBuilder;
use components\tickets\forms\TicketBuilder;
use components\departments\serialization\DepartmentSerializer;
use components\claims\serialization\ClaimPhaseSerializer;
use components\tickets\serialization\TicketCategorySerializer;
use components\tickets\serialization\TicketPrioritySerializer;
use components\tickets\serialization\TicketTypeSerializer;

/**
 * TicketsController
 *
 * @author Dave Meikle
 */
class TicketsController extends AbstractController {

    /**
     * edit - display an input form based on requested id
     *
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        $result = $this->model->edit($id);

        $this->render(array('form' => $this->drawForm($this->model, $result)));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $formBuilder = new FormBuilder($this->logger, $model);
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $builder = new TicketBuilder();
        $builder->setLocales($this->httpRequest->getAttribute('locales'));

        $options = array(
            'locales' => $this->httpRequest->getAttribute('locales'),
            'departments' => $this->buildDepartments($values),
            'claimphases' => $this->buildClaimPhases($values),
            'ticketcategories' => $this->buildTicketCategories($values),
            'ticketpriorities' => $this->buildPriorities($values),
            'tickettypes' => $this->buildTicketTypes($values)
        );

        return $builder->buildForm($formBuilder, $values, $options, $results);
    }

    private function buildTicketCategories(array $values = null) {
        //loaded from listener
        $categories = $this->httpRequest->getAttribute('TicketCategorys');
        $categorySerializer = new TicketCategorySerializer();

        return $categorySerializer->formatSelectionBoxOptions($categories, $values, 'category');
    }

    private function buildClaimPhases(array $values = null) {
        //loaded from listener
        $phases = $this->httpRequest->getAttribute('ClaimPhases');
        $phaseSerializer = new ClaimPhaseSerializer();

        return $phaseSerializer->formatSelectionBoxOptions($phases, $values, 'description');
    }

    private function buildTicketTypes(array $values = null) {
        //loaded from listener
        $types = $this->httpRequest->getAttribute('TicketTypes');
        $typeSerializer = new TicketTypeSerializer();

        return $typeSerializer->formatSelectionBoxOptions($types, $values, 'type');
    }

    private function buildPriorities(array $values = null) {
        //loaded from listener
        $priorities = $this->httpRequest->getAttribute('TicketPrioritys');
        $prioritySerializer = new TicketPrioritySerializer();

        return $prioritySerializer->formatSelectionBoxOptions($priorities, $values, 'name');
    }

    private function buildDepartments(array $values = null) {

        //loaded from listener
        $departments = $this->httpRequest->getAttribute('Departments');
        pr($departments);
        $departmentSerializer = new DepartmentSerializer();

        return $departmentSerializer->formatSelectionBoxOptions($departments, $values, 'name');
    }

    public function changeAssignedStaff($ticketId) {
        $params = $this->httpRequest->getPost();
        $newStaffId = intval($params['staffId']);
        $this->model->changeAssignedStaff(intval($ticketId), $newStaffId, $this->getLoggedInUser()->getId());

        $this->render(array('result' => 'success'));
    }

    public function getOpenCount() {
        $result = $this->model->getOpenCount();
        $retval = array('numRows' => 0);
        if (is_array($result) && array_key_exists('count', $result)) {
            $retval = current($result['count']);
        }
        $this->render($retval);
    }

}
