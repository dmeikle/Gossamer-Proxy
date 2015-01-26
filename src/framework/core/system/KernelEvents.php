<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\system;

/**
 * a container of constant strings used by the Framework for events to be
 * raised for the EventDispatcher. Developer is free to call their own
 * custom events at any time - this file is just used as static framework calls
 * 
 * @author Dave Meikle
 */
final class KernelEvents {

    const ENTRY_POINT = 'entry_point';

    /**
     * The REQUEST event occurs at the very beginning of request
     * dispatching
     */
    const REQUEST_START = 'request_start';
    const REQUEST_END = 'request_end';

    /**
     * The EXCEPTION event occurs when an uncaught exception appears
     */
    const EXCEPTION = 'exception';

    /**
     * The VIEW event occurs when the return value of a controller
     * is not a Response instance
     */
    const VIEW = 'view';

    /**
     * The CONTROLLER event occurs once a controller was found for
     * handling a request
     */
    const CONTROLLER = 'controller';

    /**
     * The RESPONSE event occurs once a response was created for
     * replying to a request
     */
    const RESPONSE_START = 'response_start';
    const RESPONSE_END = 'response_end';

    /**
     * used if we are suddenly stopping the rest of the request and going to
     * a page draw. An example is making a page request and we find a cached
     * page - no need to continue to the controller that makes a database call,
     * just send the static HTML out and quit the request.
     */
    const RENDER_BYPASS = 'render_bypass';
    const RENDER_COMPLETE = 'render_complete';

    /**
     * The TERMINATE event occurs once a response was sent
     */
    const TERMINATE = 'terminate';

}
