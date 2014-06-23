<?php

namespace core\views;

use core\AbstractView;

class TemplateView extends AbstractView
{
    private $sections = null;
    
    private $isMobile = false;
    
    private function loadTemplate($template, $theme)
    {
        if($this->agentType['isMobile']) {
            $filepath = __SITE_PATH . "/src/themes/$theme/mobile/$template";
        }else {
            $filepath = __SITE_PATH . "/src/themes/$theme/templates/$template";
        }
        
       
        $this->template = file_get_contents($filepath);
    }
    
    
    protected function renderView(){
     
        $template = $this->config['template'];
        $theme = $this->config['theme'];
        $this->sections = $this->config['sections'];
              
        $this->loadTemplate($template, $theme);
        $this->renderSections();
    }
    
    private function renderSections() {

        if(is_null($this->sections)) {

            return;
        }

        foreach($this->sections as $sectionName => $section) {
            $sectionNamePlaceHolder = '<!---' . $sectionName . '--->';

            $this->template = str_replace($sectionNamePlaceHolder, $this->loadSectionContent($section), $this->template);
        }
    }

    private function loadSectionContent($section) {

        return file_get_contents(__SITE_PATH . '/src/' . $section);
    }
}
