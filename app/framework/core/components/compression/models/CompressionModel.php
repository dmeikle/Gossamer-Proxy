<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\compression\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 * CompressionModel
 *
 * @author Dave Meikle
 */
class CompressionModel extends AbstractModel {

    /**
     *
     * @param HTTPRequest $httpRequest
     * @param HTTPResponse $httpResponse
     * @param Logger $logger
     */
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse = null, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);
    }

    public function loadFiles($fileList, $type) {

        $elements = explode(',', $fileList);
        $contents = '';
        while (list(, $element) = each($elements)) {
            if ($type != substr($element, strlen($element) - strlen($type))) {
                throw new \Exception('invalid file type requested');
            }
            $path = __SITE_PATH . '/web/' . $type . '/' . $element;

            $contents .= "\n\n" . file_get_contents($path);
        }

        return $contents;
    }

}
