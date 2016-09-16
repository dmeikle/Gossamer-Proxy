<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core;

use Monolog\Logger;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use core\datasources\DataSourceInterface;
use libraries\utils\Container;
use libraries\utils\Pagination;
use Gossamer\Caching\CacheManager;
use core\components\mappings\models\MappingModel;
use libraries\utils\preferences\UserPreferencesManager;
use libraries\utils\preferences\UserPreferences;

/**
 * abstract base class for models
 *
 * @author Dave Meikle
 */
class AbstractAPIModel extends AbstractModel {

    public function load(array $params) {
        return $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
    }

}
