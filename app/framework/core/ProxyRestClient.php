<?php
/**
 * Created by PhpStorm.
 * User: dave
 * Date: 9/9/2016
 * Time: 4:39 PM
 */

namespace core;


class ProxyRestClient extends RestClient
{
    public function decode_response() {
        if (empty($this->decoded_response)) {
            $format = $this->get_response_format();

            if (!array_key_exists($format, $this->options['decoders']))
                throw new RestClientException("'${format}' is not a supported " .
                    "format, register a decoder to handle this response.");

            $this->decoded_response = call_user_func(
                $this->options['decoders'][$format], $this->response);
        }

        $result = json_decode(json_encode($this->decoded_response), true);

        return $result;
    }
}