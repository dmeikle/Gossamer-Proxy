<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
require_once('../vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php');


$settings = array(
        'oauth_access_token' => "874094586-baTudjt9mnnLqDTKiBD3Ir2jhzmHrRR8HItGVWbS",
        'oauth_access_token_secret' => "s5q9rrfJgJftVp3L73Fw5NVtKB2Rx5nAYiX2KMUyUuJmV",
        'consumer_key' => "YMz5fs0XbKG6AQE3f5x9FxtX2",
        'consumer_secret' => "iIaxj9XBN6OQVuoJx3scC6bGzA1nBzjDCBYdBH1sBB8kkC9R00"
    );

//$url = 'https://api.twitter.com/1.1/blocks/create.json';
//    $requestMethod = 'POST';
//    
//$twitter = new TwitterAPIExchange($settings);
//    echo $twitter->buildOauth($url, $requestMethod)
//                 ->setPostfields($postfields)
//                 ->performRequest();
    
    
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $getfield = '?screen_name=am730traffic&count=20';
    $requestMethod = 'GET';

    $twitter = new TwitterAPIExchange($settings);
   

$string = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(),$assoc = TRUE);    

if(array_key_exists('errors', $string) && $string["errors"][0]["message"] != "") {
    echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";
    exit();
    
}
foreach($string as $key => $value) {
    echo '<div class="time">' . $value['created_at'] . '</div>';
    echo '<div class="subject">' . $value['text'] . '</div>';
}