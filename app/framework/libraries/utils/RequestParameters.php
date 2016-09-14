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
 *               - determines name and value based on configuration
 *
 * @author Dave Meikle
 * Copyright: Quantum Unit Solutions 2013
 */
class RequestParameters
{

    private $uri;

    private $container = null;

    private $config;


    /**
     * constructor
     *
     * @param string    method (optional)
     */
    public function __construct($uri)
    {
        $this->uri = $uri;

    }

    /**
     * @param Container $container
     */
    public function setContainer(Container $container) {
        $this->container = $container;

        $this->config = $this->container->get('HTTPRequest')->getNodeConfig();
    }

    public function getURIParameters() {
        pr($this->config);
        die;
    }
}
