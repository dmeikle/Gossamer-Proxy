<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\datasources;

/**
 * this class has been deprecated
 */
class QueryParams {

    private $entity;
    private $params;

    public function __construct($entity, array $params) {
        $this->entity = $entity;
        $this->params = $params;
    }

    public function getEntity() {
        return $this->entity;
    }

    public function getParameters() {
        return $this->params;
    }

}
