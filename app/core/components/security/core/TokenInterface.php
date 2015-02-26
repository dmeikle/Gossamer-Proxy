<?php

namespace core\components\security\core;

use core\components\security\core\Client;
/**
 * Description of TokenInterface
 *
 * @author Dave Meikle
 */
interface TokenInterface {
   public function toString();
   
   public function getRoles();
   
   public function getClient();
   
   public function setClient(Client $client);
   
   public function getIdentity();
   
   public function isAuthenticated();
   
   public function setAuthenticated($isAuthenticated);
   
   public function setAttribute($name, mixed $value);
   
   public function getAttributes();
   
   public function setAttributes(array $attributes);
   
   public function eraseCredentials();
}
