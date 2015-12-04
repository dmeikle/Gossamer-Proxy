<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\controllers;

use core\AbstractController;
use components\geography\serialization\ProvinceSerializer;
use components\departments\serialization\DepartmentSerializer;
use components\staff\serialization\StaffTypeSerializer;
use components\staff\form\StaffBuilder;
use components\staff\form\StaffAuthorizationBuilder;
use components\staff\form\StaffEmergencyContactBuilder;
use Gossamer\CMS\Forms\FormBuilder;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\system\Router;
use components\staff\serialization\StaffSerializer;
use components\staff\serialization\StaffPositionsSerializer;
use core\eventlisteners\Event;
use libraries\utils\Pagination;

class StaffController extends AbstractController {

    public function save($id) {

        $result = $this->getEntity('Staff', $this->model->save(intval($id)));
        $entity = $this->getEntity('Staff', $result);

        //TODO: figure out where to redirect if result holds no 'id' key
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('admin_staff_credentials_edit', array($result['id']));
    }

    public function search() {
        $result = $this->httpRequest->getAttribute($this->getSearchKey());

        if (!is_array($result)) {
            $result = $this->model->search($this->httpRequest->getQueryParameters());
            $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'load_success', new Event('load_success', $result));
        }

        $this->render($result);
    }

    private function getSearchKey() {
        $params = $this->httpRequest->getQueryParameters();

        return 'search/staff_' . $params['name'];
    }

    public function searchByName() {
        $results = $this->model->search(array('firstname' => $this->getName()));

        $serializer = new StaffSerializer();
        $list = $serializer->formatNameResults($results);

        $this->render($list);
    }

    private function getName() {
        $rawName = $this->httpRequest->getQueryParameter('term');

        return preg_replace('/[^A-z]/', '', substr($rawName, 0, 10));
    }

    public function ajaxSave($id = null) {

        $result = $this->model->save(intval($id));
        error_log('here ' . print_r($result, true));
        $this->render($result);
    }

    public function index() {
        $result = array();

        $this->render($result);
    }

    public function createNew() {
        $this->edit(0);
    }

    /**
     * edit - display an input form based on requested id
     *
     * @param int id    primary key of item to edit
     */
    public function edit($id) {
        $result = (intval($id) > 0) ? $this->model->edit(intval($id)) : array();
        $staffAuthorization = new \components\staff\models\StaffAuthorizationModel($this->httpRequest, $this->httpResponse, $this->logger);

        $result['form'] = $this->drawForm($this->model, $result);
        if (is_array($result)) {
            $result['eform'] = $this->drawEmergencyContactForm($this->model, array());


            $staffAuth = $this->httpRequest->getAttribute('StaffAuthorization');
            if (is_array($staffAuth) && array_key_exists('StaffAuthorization', $staffAuth)) {
                $result['aform'] = $this->drawCredentialsForm($staffAuthorization, $staffAuth['StaffAuthorization'][0]);
            }
        }

        if (intval($id) == 0) {
            $result['aform'] = $this->drawCredentialsForm($staffAuthorization, array());
        }
        $result['id'] = intval($id);

        $this->render($result);
    }

    public function get($id) {
        $result = $this->model->edit(intval($id));
        unset($result['emergencyContacts']);

        $this->render(array('Staff' => $result));
    }

    protected function drawForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $staffBuilder = new StaffBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');


        $provinceList = $this->httpRequest->getAttribute('Provinces');
        $serializer = new ProvinceSerializer();
        $selectedOptions = array($staffBuilder->getValue('Provinces_id', $values));
        $options = array('provinces' => $serializer->formatSelectionBoxOptions($serializer->pruneList($provinceList), $selectedOptions));

        $positions = $this->httpRequest->getAttribute('StaffPositions');
        $serializer = new StaffPositionsSerializer();
        $selectedOptions = array($staffBuilder->getValue('StaffPositions_id', $values));
        $options['staffPositions'] = $serializer->formatSelectionBoxOptions($serializer->pruneList($positions), $selectedOptions);

        $departments = $this->httpRequest->getAttribute('Departments');
        $serializer = new DepartmentSerializer();
        $selectedOptions = array($staffBuilder->getValue('Departments_id', $values));
        $options['departments'] = $serializer->formatSelectionBoxOptions($serializer->pruneList($departments), $selectedOptions);

        $types = $this->httpRequest->getAttribute('StaffTypes');
        $serializer = new StaffTypeSerializer();
        $selectedOptions = array($staffBuilder->getValue('StaffTypes_id', $values));
        $options['staffTypes'] = $serializer->formatSelectionBoxOptions($serializer->pruneList($positions), $selectedOptions);

        return $staffBuilder->buildForm($builder, $values, $options, $results);
    }

    protected function drawEmergencyContactForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $staffBuilder = new StaffEmergencyContactBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $options = array();

        return $staffBuilder->buildForm($builder, $values, $options, $results);
    }

    protected function drawCredentialsForm(FormBuilderInterface $model, array $values = null) {
        $builder = new FormBuilder($this->logger, $model);
        $authorizationBuilder = new StaffAuthorizationBuilder();
        $results = $this->httpRequest->getAttribute('ERROR_RESULT');

        $options = array();

        return $authorizationBuilder->buildCredentialsForm($builder, $values, $options, $results);
    }

    public function uploadPhoto($id) {
        $filenames = array();
        $staffImagePath = __UPLOADED_IMAGES_PATH . 'staff' . DIRECTORY_SEPARATOR;

        $this->mkdir($staffImagePath);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $staffImagePath . $_FILES['file']['name'])) {
            $params = array('id' => intval($id), 'imageName' => $_FILES['file']['name']);

            $this->model->saveParams($params);
        }

        $this->render(array('success' => 'true'));
    }

    /**
     * Creates a directory recursively.
     *
     * @param string|array|\Traversable $dirs The directory path
     * @param int                       $mode The directory mode
     *
     * @throws IOException On any directory creation failure
     */
    // private function mkdir($dirs, $mode = 0777) {
    //     foreach ($this->toIterator($dirs) as $dir) {
    //         if (is_dir($dir)) {
    //             continue;
    //         }

    //         if (true !== @mkdir($dir, $mode, true)) {
    //             $error = error_get_last();
    //             if (!is_dir($dir)) {
    //                 // The directory was not created by a concurrent process. Let's throw an exception with a developer friendly error message if we have one
    //                 if ($error) {
    //                     throw new IOException(sprintf('Failed to create "%s": %s.', $dir, $error['message']), 0, null);
    //                 }
    //                 throw new IOException(sprintf('Failed to create "%s"', $dir), 0, null);
    //             }
    //         }
    //     }
    // }

    /**
     * @param mixed $files
     *
     * @return \Traversable
     */
    private function toIterator($files) {
        if (!$files instanceof \Traversable) {
            $files = new \ArrayObject(is_array($files) ? $files : array($files));
        }

        return $files;
    }

    /**
     * listall - retrieves rows based on offset, limit
     *
     * @param int offset    database page to start at
     * @param int limit     max rows to return
     */
    public function listall($offset = 0, $limit = 20) {
        $result = $this->model->listall($offset, $limit);

        $this->render($result);
    }

}
