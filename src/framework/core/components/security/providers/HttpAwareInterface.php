<?php

namespace core\components\security\providers;

use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;

/**
 *
 * @author davem
 */
interface HttpAwareInterface {
    
    public function setHttpRequest(HTTPRequest $request);
    public function setHttpResponse(HTTPResponse $response);
    public function setLogger(Logger $logger);
}
