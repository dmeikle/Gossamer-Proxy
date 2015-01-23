<?php


namespace core\system;


final class KernelEvents
{
    
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

    const RENDER_BYPASS = 'render_bypass';
    
    const RENDER_COMPLETE = 'render_complete';
    /**
     * The TERMINATE event occurs once a response was sent
     */
    const TERMINATE = 'terminate';
}
