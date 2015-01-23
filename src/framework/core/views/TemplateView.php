<?php

namespace core\views;

use core\AbstractView;
use core\handlers\ImportJSHandler;
use core\handlers\ImportCSSHandler;
use core\handlers\URITagHandler;
use core\handlers\HTMLTagHandler;


class TemplateView extends AbstractView
{
    private $sections = null;
    
    private $isMobile = false;

    private $jsIncludeFiles = array();

    private $cssIncludeFiles = array();
    
    protected function loadTemplate($template, $theme)
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
        $this->renderHTMLTags();
        $this->placeJSFiles();
        $this->placeCSSFiles();
        $this->renderURITags($template);
    }
    
    private function renderURITags() {
        $uriHandler = new URITagHandler($this->logger);
        
        $uriHandler->setTemplate($this->template);
        $this->template = $uriHandler->handlerequest();        
    }
    
    private function renderHTMLTags() {
       $htmlHandler = new HTMLTagHandler($this->logger);
       $htmlHandler->setDefaultLocale($this->getDefaultLocale());
       $htmlHandler->setTemplate($this->template);
       $this->template = $htmlHandler->handleRequest($this->data);
    }

    private  function placeJSFiles() {
        $jsIncludeString = '';

        foreach($this->jsIncludeFiles as $file) {
            $jsIncludeString .= "<script language=\"javascript\" src=\"$file\"></script>\r\n";
        }

        $this->template = str_replace('<!---javascript--->', $jsIncludeString, $this->template);
    }

    private  function placeCSSFiles() {
        $cssIncludeString = '';

        foreach($this->cssIncludeFiles as $file) {
            $cssIncludeString .= "<link href=\"$file\" rel=\"stylesheet\">\r\n";
        }

        $this->template = str_replace('<!---css--->', $cssIncludeString, $this->template);
    }

    private function renderSections() {

        if(is_null($this->sections)) {

            return;
        }

        foreach($this->sections as $sectionName => $section) {
            if(!is_array($section)) {
                $sectionNamePlaceHolder = '<!---' . $sectionName . '--->';
                $this->template = str_replace($sectionNamePlaceHolder, $this->loadSectionContent($section), $this->template);
            } else {
                foreach($section as $subSectionName => $subSection) {
                     $sectionNamePlaceHolder = '<!---' . $subSectionName . '--->';
                    $this->template = str_replace($sectionNamePlaceHolder, $this->loadSectionContent($subSection), $this->template);
                }
            }
            
        }

    }

    private function loadSectionContent($section) {

        $sectionContent = file_get_contents(__SITE_PATH . DIRECTORY_SEPARATOR . $section);

        $contentWithJs = $this->renderJs($sectionContent);

        $contentWithCss = $this->renderCss($contentWithJs);

        if(is_array($contentWithCss)) {
            return implode('', $contentWithCss);
        }

        return $contentWithCss;

    }


    private function renderJs($sectionContent) {

        $frontchunks = explode('<!--- javascript start --->', $sectionContent);
        if(count($frontchunks) < 2) {
            return $frontchunks;
        }

        $frontchunk = array_shift($frontchunks);

        $backchunks = explode('<!--- javascript end --->', current($frontchunks));

        $jslist = explode("\n", ($backchunks[0]));

        $jshandler = new ImportJSHandler($this->logger);
        $parselist = $jshandler->handlerequest($jslist);
        $this->jsIncludeFiles = $parselist;

        return $frontchunk .
            $backchunks[1];


    }

    private function renderCss($sectionContent) {
        if(is_array($sectionContent)){
            $sectionContent = implode('', $sectionContent);
        }

        $frontchunks = explode('<!--- css start --->', $sectionContent);
        if(count($frontchunks) < 2) {
            return $frontchunks;
        }

        $frontchunk = array_shift($frontchunks);

        $backchunks = explode('<!--- css end --->', current($frontchunks));

        $cssList = explode("\n", ($backchunks[0]));

        $cssHandler = new ImportCSSHandler($this->logger);
        $parseList = $cssHandler->handlerequest($cssList);
        $this->cssIncludeFiles = $parseList;

        $retval =  $frontchunk .  $backchunks[1];

        if(is_array($retval)) {
            return implode('', $retval);
        }
        return $retval;
    }
    
}
