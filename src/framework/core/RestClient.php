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

/**
 * PHP REST Client
 * https://github.com/tcdent/php-restclient
 * (c) 2013 Travis Dent <tcdent@gmail.com>
 */
use libraries\utils\UnicodeHandler;
use \libraries\utils\YAMLParser;
use Monolog\Logger;

class RestClientException extends \Exception {

}

class RestClient implements \Iterator, \ArrayAccess {

    public $options;
    public $handle; // cURL resource handle.
    // Populated after execution:
    public $response; // Response body.
    public $headers; // Parsed reponse header object.
    public $info; // Response info object.
    public $error; // Response error string.
    // Populated as-needed.
    public $decoded_response; // Decoded response body.
    private $iterator_positon;
    private $logger = null;
    private $lastUrl = '';

    public function __construct($options = array()) {
        $default_options = array(
            'headers' => array(),
            'parameters' => array(),
            'curl_options' => array(),
            'user_agent' => "PHP RestClient/0.1.1",
            'base_url' => NULL,
            'format' => NULL,
            'format_regex' => "/(\w+)\/(\w+)(;[.+])?/",
            'decoders' => array(
                'json' => 'json_decode',
                'php' => 'unserialize'
            ),
            'username' => NULL,
            'password' => NULL
        );

        $this->options = array_merge($default_options, $options);
        if (array_key_exists('decoders', $options))
            $this->options['decoders'] = array_merge(
                    $default_options['decoders'], $options['decoders']);
    }

    public function setLogger(Logger $logger) {
        $this->logger = $logger;
    }

    public function set_option($key, $value) {
        $this->options[$key] = $value;
    }

    public function register_decoder($format, $method) {
        // Decoder callbacks must adhere to the following pattern:
        //   array my_decoder(string $data)
        $this->options['decoders'][$format] = $method;
    }

    // Iterable methods:
    public function rewind() {
        $this->decode_response();
        return reset($this->decoded_response);
    }

    public function current() {
        return current($this->decoded_response);
    }

    public function key() {
        return key($this->decoded_response);
    }

    public function next() {
        return next($this->decoded_response);
    }

    public function valid() {
        return is_array($this->decoded_response) && (key($this->decoded_response) !== NULL);
    }

    // ArrayAccess methods:
    public function offsetExists($key) {
        $this->decode_response();
        return is_array($this->decoded_response) ?
                isset($this->decoded_response[$key]) : isset($this->decoded_response->{$key});
    }

    public function offsetGet($key) {
        $this->decode_response();
        if (!$this->offsetExists($key))
            return NULL;

        return is_array($this->decoded_response) ?
                $this->decoded_response[$key] : $this->decoded_response->{$key};
    }

    public function offsetSet($key, $value) {
        throw new RestClientException("Decoded response data is immutable.");
    }

    public function offsetUnset($key) {
        throw new RestClientException("Decoded response data is immutable.");
    }

    // Request methods:
    public function get($url, $parameters = array(), $headers = array()) {
        return $this->execute($url, 'GET', $parameters, $headers);
    }

    public function post($url, $parameters = array(), $headers = array()) {

        return $this->execute($url, 'POST', $parameters, $headers);
    }

    public function put($url, $parameters = array(), $headers = array()) {
        $parameters['_method'] = "PUT";
        return $this->execute($url, 'POST', $parameters, $headers);
    }

    public function delete($url, $parameters = array(), $headers = array()) {
        $parameters['_method'] = "DELETE";
        return $this->execute($url, 'POST', $parameters, $headers);
    }

// to curl upload an image:
//$ch = curl_init();
//$data = array('name' => 'Foo', 'file' => '@/path/to/image.jpeg');
//curl_setopt($ch, CURLOPT_URL, 'http://localhost/upload.php');
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//curl_exec($ch);

    public function execute($url, $method = 'GET', $parameters = array(), $headers = array()) {
        $client = clone $this;
        $client->url = $url;
        $client->handle = curl_init();
        $curlopt = array(
            CURLOPT_HEADER => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_USERAGENT => $client->options['user_agent']
        );

        if ($client->options['username'] && $client->options['password'])
            $curlopt[CURLOPT_USERPWD] = sprintf("%s:%s", $client->options['username'], $client->options['password']);

        if (count($client->options['headers']) || count($headers)) {
            $curlopt[CURLOPT_HTTPHEADER] = array();

            $headers = array_merge($client->options['headers'], $headers);
            foreach ($headers as $key => $value) {
                $curlopt[CURLOPT_HTTPHEADER][] = sprintf("%s:%s", $key, $value);
            }
        }

        //   if($client->options['format'])
        //      $client->url .= '.'.$client->options['format'];

        $parameters = array_merge($client->options['parameters'], $parameters);

        if (strtoupper($method) == 'POST') {
            $curlopt[CURLOPT_POST] = TRUE;
            $curlopt[CURLOPT_POSTFIELDS] = $client->format_query($parameters);
            // echo $client->format_query($parameters);
        } elseif (count($parameters)) {
            $client->url .= strpos($client->url, '?') ? '&' : '?';

            $client->url .= $this->buildGetParameters($parameters); //http_build_query($parameters);
        }

        if ($client->options['base_url']) {
            if ($client->url[0] != '/' || substr($client->options['base_url'], -1) != '/')
                $client->url = '/' . $client->url;
            $client->url = $client->options['base_url'] . $client->url;
        }

        $curlopt[CURLOPT_URL] = $client->url;
        curl_setopt($client->handle, CURLOPT_ENCODING, "");
        if ($client->options['curl_options']) {
            // array_merge would reset our numeric keys.
            foreach ($client->options['curl_options'] as $key => $value) {
                $curlopt[$key] = $value;
            }
        }
        $this->lastUrl = $client->url;
        curl_setopt_array($client->handle, $curlopt);

        $client->parse_response(curl_exec($client->handle));
        $client->info = (object) curl_getinfo($client->handle);
        $client->error = curl_error($client->handle);

        curl_close($client->handle);

        return $client;
    }

    private function buildGetParameters($parameters) {
        $uh = new UnicodeHandler($this->logger, $this->loadEncodingConfiguration());

        $parameters = $uh->encode($parameters); // $this->formatToHexForSending($parameters);
        unset($uh);
        $retval = '';
        foreach ($parameters as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $subkey => $subvalue) {
                    //for now, lets just assume no one sends an array as get params deeper than 1 level
                    $retval .= "&" . trim($subkey) . "=" . urlencode($subvalue);
                }
            } else {
                $retval .= "&" . trim($key) . "=" . urlencode($value);
            }
        }

        return substr($retval, 1);
    }

    public function format_query($parameters, $primary = '=', $secondary = '&') {
        $query = "";
        $uh = new UnicodeHandler($this->logger, $this->loadEncodingConfiguration());

        $parameters = $uh->encode($parameters); // $this->formatToHexForSending($parameters);

        unset($uh);
        foreach ($parameters as $key => $value) {
            if (is_array($value)) {
                $value = json_encode($value);
            }

            $pair = array(($key), ($value));
            $query .= implode($primary, $pair) . $secondary;
        }

        return rtrim($query, $secondary);
    }

    public function parse_response($response) {
        $headers = array();
        $http_ver = strtok($response, "\n");

        while ($line = strtok("\n")) {
            if (strlen(trim($line)) == 0)
                break;

            list($key, $value) = explode(':', $line, 2);
            $key = trim(strtolower(str_replace('-', '_', $key)));
            $value = trim($value);

            if (empty($headers[$key]))
                $headers[$key] = $value;
            elseif (is_array($headers[$key]))
                $headers[$key][] = $value;
            else
                $headers[$key] = array($headers[$key], $value);
        }

        $this->headers = (object) $headers;
        $this->response = strtok("");
    }

    public function get_response_format() {
        if (!$this->response)
            throw new RestClientException("last URL: " . $this->lastUrl . "\r\nA response must exist before it can be decoded.");

        // User-defined format.
        if (!empty($this->options['format']))
            return $this->options['format'];

        // Extract format from response content-type header.
        if (!empty($this->headers->content_type))
            if (preg_match($this->options['format_regex'], $this->headers->content_type, $matches))
                return $matches[2];

        throw new RestClientException(
        "Response format could not be determined.");
    }

    private function loadEncodingConfiguration() {

        $loader = new YAMLParser($this->logger);
        //check to see if it's a core component, then add 'core' to the path if yes
        $loader->setFilePath(__SITE_PATH . DIRECTORY_SEPARATOR . __NAMESPACE . DIRECTORY_SEPARATOR . ((strpos(__NAMESPACE, 'framework') !== false) ? 'core' . DIRECTORY_SEPARATOR : '') .
                __COMPONENT_FOLDER . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'encodings.yml');
        $config = $loader->loadConfig();

        unset($loader);

        return $config;
    }

    public function decode_response() {

        if (empty($this->decoded_response)) {
            $format = $this->get_response_format();

            if (!array_key_exists($format, $this->options['decoders']))
                throw new RestClientException("'${format}' is not a supported " .
                "format, register a decoder to handle this response.");

            $this->decoded_response = call_user_func(
                    $this->options['decoders'][$format], $this->response);
        }
//pr($this->response);

        $uh = new UnicodeHandler($this->logger, $this->loadEncodingConfiguration());

        $this->decoded_response = $uh->decode($this->decoded_response);

        //$this->decoded_response = $uh->decode($this->decoded_response);
        unset($uh);
        $result = json_decode(json_encode($this->decoded_response), true);


        return $result;
    }

    private function text2bin($parameters) {
        $retval = array();
        $bin = '';
        foreach ($parameters as $key => $value) {
            if (is_array($value)) {
                $retval[$key] = $this->text2bin($value);
            } else {
                $len = strlen($value);

                for ($i = 0; $i < $len; $i++) {
                    $bin .= strlen(decbin(ord($value[$i]))) < 8 ? str_pad(decbin(ord($value[$i])), 8, 0, STR_PAD_LEFT) : decbin(ord($value[$i]));
                }
                $retval[$key] = $bin;
            }
        }

        return $retval;
    }

    private function convertObjectToArray($object) {
        $retval = array();
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        foreach ($object as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $retval[$key] = $this->convertObjectToArray($value);
            } else {
                $retval[$key] = $value;
            }
        }

        return $retval;
    }

    private function formatToAsciiAfterReceiving($parameters) {
        $retval = array();


        if (!is_array($parameters)) {
            return $this->hex2ascii($parameters);
        }
        foreach ($parameters as $key => $value) {
            if (is_array($value)) {
                $retval[$key] = $this->formatToAsciiAfterReceiving($value);
            } else {
                $retval[$key] = $this->hex2ascii($value);
            }
        }

        return $retval;
    }

    private function formatToHexForSending($parameters) {
        $retval = array();
        if (!is_array($parameters)) {
            return $this->ascii2hex($parameters);
        }
        foreach ($parameters as $key => $value) {
            if (is_array($parameters)) {
                $retval[$key] = $this->formatToHexForSending($value);
            } else {
                $retval[$key] = $this->ascii2hex($value);
            }
        }

        return $retval;
    }

    private function ascii2hex($ascii) {
        //add quotes to cast as string from int value otherwise this cheap-oh method falls over
        $ascii = "" . $ascii;
        $hex = '';
        for ($i = 0; $i < strlen($ascii); $i++) {
            $byte = strtoupper(dechex(ord($ascii{$i})));
            $byte = str_repeat('0', 2 - strlen($byte)) . $byte;
            $hex .= $byte . " ";
        }

        return $hex;
    }

    private function hex2ascii($hex) {
        if (is_object($hex)) {
            return $hex;
        }
        $ascii = '';
        $hex = str_replace(" ", "", $hex);
        for ($i = 0; $i < strlen($hex); $i = $i + 2) {
            $ascii.=chr(hexdec(substr($hex, $i, 2)));
        }
        return($ascii);
    }

}
