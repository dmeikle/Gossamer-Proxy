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

use database\DBConnection;

/**
 * Request class - used to protect system from directly accessing $_REQUEST values
 *               - and mysql escaping them before permitting access to them
 *
 * @author Dave Meikle
 * Copyright: Quantum Unit Solutions 2013
 */
class RequestParameters {

    /**
     * we need a connection so we can access the mysql methods
     */
    private $conn = null;

    /**
     * the request method we are handling
     */
    private $method;

    /**
     * array of parameters we receive
     */
    private $params = null;

    /**
     * constructor
     *
     * @param string    method (optional)
     */
    public function __construct($method = null) {
        $this->method = $method;
    }

    /**
     * getConnection
     *
     * we just need any connection so no need to inject one
     *
     * @return DBConnection conn
     */
    private function getConnection() {
        if (is_null($this->conn)) {
            $this->conn = new DBConnection();
        }

        return $this->conn->getConnection();
    }

    /**
     * setParams - accessor
     *
     * @param array     params - received params from either $_POST or $_GET
     */
    public function setParams($params) {
        $this->params = $this->scrub($params);
    }

    /**
     * get - returns a value from the parameters scrubbed
     *
     * @param string    fieldname
     *
     * @return variant
     */
    public function get($fieldName) {
        return $this->params[$fieldname];
    }

    /**
     * scrub - mysql escapes passed in values
     *
     * @param string|array  params - values to scrub
     *
     * @return string|array the escaped values
     */
    public function scrub($params) {
        $conn = $this->getConnection();
        if (!is_array($params)) {
            return mysqli_real_escape_string($conn, $params);
        }
        $retval = array();
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $retval[$key] = $this->scrub($value);
            } else {
                $retval[$key] = mysqli_real_escape_string($conn, $value);
            }
        }

        return $retval;
    }

    /**
     * getParams - returns the complete list
     *
     * @return array
     */
    public function getParams() {
        return $this->params;
    }

}
