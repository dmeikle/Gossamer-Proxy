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
 * Description of ClaimPhotoModel
 *
 * @author Dave Meikle
 */
class ClaimPhotoModel extends AbstractModel implements FormBuilderInterface, \core\UploadableInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'ClaimPhoto';
        $this->tablename = 'locationsphotos';
    }

    public function getFormWrapper() {
        return $this->entity;
    }

    public function listByClaimId($claimId) {
        $params = array('jobNumber' => $claimId);

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);

        return $data;
    }

    public function getUploadPath() {
        return __UPLOADED_FILES_PATH . 'images';
    }

    public function saveParamsOnComplete(array $params) {

        return $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, array('ClaimPhotos' => $params));
    }

}
