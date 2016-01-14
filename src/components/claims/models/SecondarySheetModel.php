<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

/**
 * Description of SecondarySheetModel
 *
 * @author Dave Meikle
 */
class SecondarySheetModel extends AbstractModel implements FormBuilderInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'SecondarySheet';
        $this->tablename = 'affectedareassecondarysheets';
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    /**
     * this is for saving the selected form inputs to display later
     *
     * @param type $claimId
     * @param type $locationId
     * @param type $affectedAreasId
     * @param type $sheetId
     */
    public function saveAllResponsesBySheetId($claimId, $locationId, $affectedAreasId, $sheetId) {
        $params = $this->httpRequest->getPost();

        $params[$this->entity]['Staff_id'] = $this->getLoggedInStaffId();
        $params[$this->entity]['id'] = intval($sheetId);
        $params[$this->entity]['AffectedAreasSecondarySheets_id'] = intval($sheetId);

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params[$this->entity]);

        return $data;
    }

}
