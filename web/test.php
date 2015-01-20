<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$url =  $_SERVER['HTTP_HOST'] . '/admin/login'; 

echo $url.'<br>';
$needle = '<b id="info">'; 
$contents = file_get_contents( $url); 

print_r($contents);
die;
if(strpos($contents, $needle)!== false) { 
echo 'found'; 
} else { 
echo 'not found'; 
} 

?>