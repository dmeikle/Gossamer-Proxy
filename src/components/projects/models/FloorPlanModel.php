<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\projects\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;
use core\eventlisteners\Event;

/**
 * Description of PropertyModel
 *
 * @author Dave Meikle
 */
class FloorPlanModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'FloorPlan';
        $this->tablename = 'floorplans';
    }

    public function saveFloorPlan($projectId, $floorPlanId) {
        $params = $this->httpRequest->getPost();

        $params['FloorPlan']['id'] = intval($floorPlanId);
        $params['FloorPlan']['ProjectAddresses_id'] = intval($projectId);
        $params['FloorPlan']['floorPlan'] = $this->httpRequest->getAttribute('newFilename');

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['FloorPlan']);

        return $data;
    }

    public function listByProject($id) {

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, array('ProjectAddresses_id' => intval($id)));

        return $data;
    }

    public function editFloorPlan($projectId, $floorPlanId) {

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, array('ProjectAddresses_id' => $projectId, 'id' => intval($floorPlanId)));

        return $data;
    }

    public function remove($projectId, $floorPlanId) {
        $data = $this->dataSource->query(self::METHOD_DELETE, $this, self::VERB_DELETE, array('ProjectAddresses_id' => $projectId, 'id' => intval($floorPlanId)));

        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'delete_success', new Event('delete_success', $data));
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
