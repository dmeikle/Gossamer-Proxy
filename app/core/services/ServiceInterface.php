<?php

namespace core\services;

use libraries\utils\Container;


/**
 * Description of ServiceInterface
 *
 * @author Dave Meikle
 */
interface ServiceInterface {
    public function setContainer(Container $container);
    
    public function setParameters(array $params);
    
    public function execute();
}
