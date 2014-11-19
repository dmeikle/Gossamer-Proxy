<?php
namespace core\datasources;

class QueryParams
{
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
