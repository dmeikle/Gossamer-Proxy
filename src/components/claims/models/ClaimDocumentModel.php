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

/**
 * Description of ClaimDocumentModel
 *
 * @author Dave Meikle
 */
class ClaimDocumentModel extends AbstractModel implements \core\UploadableInterface {

    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'ClaimDocument';
        $this->tablename = 'claimdocuments';
    }

    public function getUploadPath() {
        return __UPLOADED_FILES_PATH . 'documents';
    }

    public function saveParamsOnComplete(array $params) {
        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, array('ClaimDocuments' => $params));

        return $data;
    }

}
