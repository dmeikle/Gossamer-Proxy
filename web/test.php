<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once '../src/framework/libraries/utils/YAMLParser.php';
$a = array(
    "key1" => "value1",
    
    "key2" => "/test2",
    
    "key3" => "/test3",
    
    "key4" =>  "/test4"
);

$c = new CookieManager();

$c->setCookie('test', $a);
echo "<br>cookie set<br>reading:<br>";
print_r( $c->getCookie('test'));


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
        $cookie = $_COOKIE[$this->config['name']];
        
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

?>

<?php
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<html>
<body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}
?>