<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace exceptions;

/**
 * Error403Exception
 *
 * @author Dave Meikle
 */
class Error404Exception extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message, 404);
    }
}
