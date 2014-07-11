<?php
namespace core;

use core\AbstractView;
use core\handlers\ImportJSHandler;
use core\ViewInterface;

class TemplateView extends AbstractView implements ViewInterface
{
    private $sections = null;

    protected $template;
    

    protected function loadTemplate()
    {
        $filepath = 'templates/' . $this->template .'.php';
        $this->template = file_get_contents($filepath);
    }

    public function setTemplate($template) {
        $this->template = $template;
    }
    
    public function addSection($sectionName, $section) {

        if(!array_key_exists($sectionName, $this->getSections())) {
            $this->sections[$sectionName] = $section;
        }
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
        $content = $this->renderJs();
        return file_get_contents('classes/' . $section . '.php');
    }

    /**
     * getSections - init the method if not already initialized
     *
     * @return array sections
     */
    private function getSections() {
        if(is_null($this->sections)) {
            $this->sections = array();
        }

        return $this->sections;
    }
}
