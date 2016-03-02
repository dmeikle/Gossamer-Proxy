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
class AbstractI18nModel extends AbstractModel {

    /**
     * retrieves a row from the datasource for editing.
     * this differs from AbstractModel in that we don't specify
     * a locale, otherwise it grabs only 1 when we want them all from
     * the database
     *
     * @param int $id
     *
     * @return array
     */
    public function edit($id) {

        $locale = $this->getDefaultLocale();

        if ($this->isFailedValidationAttempt()) {

            return $this->httpRequest->getAttribute('POSTED_PARAMS');
        }

        $params = array(
            'id' => intval($id)
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);

        return $data;
    }

}
