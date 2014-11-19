<?php


namespace core\views;

use core\AbstractView;

/**
 * Description of ExceptionView
 *
 * @author davem
 */
class TemplateExceptionView extends TemplateView{
    
    
    protected function renderView(){
     
        $template = 'exception.php';
        $theme = $this->config['theme'];
        $this->sections = $this->config['sections'];
              
        $this->loadTemplate($template, $theme);        
       
    }
}
