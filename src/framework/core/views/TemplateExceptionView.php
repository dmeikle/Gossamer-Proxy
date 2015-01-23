<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\views;

use core\AbstractView;

/**
 * Description of ExceptionView
 *
 * @author Dave Meikle
 */
class TemplateExceptionView extends TemplateView{
    
    
    protected function renderView(){
     
        $template = 'exception.php';
        $theme = $this->config['theme'];
        $this->sections = $this->config['sections'];
              
        $this->loadTemplate($template, $theme);        
       
    }
}
