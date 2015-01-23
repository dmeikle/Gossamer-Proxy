<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\http;

/**
 * Description of CookieManager
 *
 * @author Dave Meikle
 */

class CookieManager {
    
    private $config = null;
    
    public function __construct() {
        $this->getCookieCredentials();
    }
    
    public function setCookie($cookieName, array $values) {        
        
        $cookieValue = json_encode($values);
        $name = $this->config['name'] . "[$cookieName]";       
        
        if($this->config['secure'] == 'true') {            
            $cookieValue = $this->encrypt($cookieValue, $cookieName);                       
        }
        
        setcookie($name, $cookieValue, time() + 86400, "/"); //86400 = 1 day        
    }
    
    public function getCookie($cookieName) { 
        
        if(!array_key_exists($this->config['name'], $_COOKIE)) {
            return null;
        }
        
        $cookie = $_COOKIE[$this->config['name']];
        
        if(!array_key_exists($cookieName, $cookie)) {
            return null;
        }
        
        $cookieValue = $cookie[$cookieName];
        
        if($this->config['secure'] == 'true') {            
            $cookieValue = $this->decrypt($cookieValue, $cookieName);                       
        }
        
        return json_decode($cookieValue, true);       
    }
    
    private function encrypt($data, $key) {
       
        $key = substr(hash('sha256', $this->config['salt'].$key.$this->config['salt']), 0, 32);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, $iv));
        
        return $encrypted;
    }
    
   private function decrypt($data, $key) {
      
      $key = substr(hash('sha256', $this->config['salt'].$key.$this->config['salt']), 0, 32);
      $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
      $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
      $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($data), MCRYPT_MODE_ECB, $iv);
      
      return $decrypted;
   }
   
   private function getCookieCredentials() {
       $this->config = array (
       'secure' => 'true',
    'salt' => 'D!dYewKn0wTh3En1gm@D3v1c#w@zaF*rM1dabL3Encyp+i0nD3v!s?',
    'name' => 'phoenix_restorations'   
       );
       
       /*
        $parser = new YAMLParser();
        $parser->setFilePath(__SITE_PATH . '/app/config/config.yml');
        
        $config = $parser->loadConfig();
        
        $this->config = $config['cookies'];
        * 
        */
   }
   
}