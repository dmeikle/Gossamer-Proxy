<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace libraries\utils;

/**
 * loads the navigation lists 
 *
 * @author Dave Meikle
 */
class YamlListParser {

    private $accumulatedList = null;

    /**
     * 
     * @param array $config
     * @param array $userRoles
     * @param string $pattern
     * 
     * @return type
     */
    public function parseList(array $config, array $userRoles, $pattern) {
        foreach ($config as $key => $node) {
            $this->checkRoles($key, $userRoles, $node, $pattern);
        }

        return $this->accumulatedList;
    }

    /**
     * 
     * @param string $key
     * @param array $userRoles
     * @param array $displayNode
     * @param string $pattern
     */
    private function checkRoles($key, array $userRoles, array $displayNode, $pattern) {

        //use intersect to check for matches
        $roles = array_intersect($displayNode[$pattern], $userRoles);

        if (count($roles) > 0) {
            $this->addToList($key, $displayNode);
        }
    }

    /**
     * 
     * @param string $key
     * 
     * @param array $item
     */
    private function addToList($key, array $item) {
        if (is_null($this->accumulatedList)) {
            $this->accumulatedList = array();
        }

        $this->accumulatedList[$key] = $item;
    }

}
