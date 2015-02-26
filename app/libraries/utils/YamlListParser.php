<?php


namespace libraries\utils;

/**
 * Description of YamlListParser
 *
 * @author davem
 */
class YamlListParser {
   
    private $accumulatedList = null;
    
    public function parseList(array $config, array $userRoles, $pattern) {
        foreach($config as $key => $node) {
            $this->checkRoles($key, $userRoles, $node, $pattern);
        }
       
        return $this->accumulatedList;
    }
    
    private function checkRoles($key, array $userRoles, array $displayNode, $pattern) {
       
        //use intersect to check for matches
        $roles = array_intersect($displayNode[$pattern], $userRoles);
        
        if(count($roles) > 0) {
            $this->addToList($key, $displayNode);
        }
    }
    
    private function addToList($key, array $item) {
        if(is_null($this->accumulatedList)) {
            $this->accumulatedList = array();
        }
        
        $this->accumulatedList[$key] = $item;
    }
}
