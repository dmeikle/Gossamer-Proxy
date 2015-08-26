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
use core\handlers\ImportJSHandler;
use core\handlers\ImportCSSHandler;
use core\handlers\URITagHandler;
use core\handlers\HTMLTagHandler;

/**
 * the view for all HTML requests that are drawn from a group of templates.
 * 
 * @author Dave Meikle
 */
class TemplateView extends AbstractView {

    protected $sections = null;
    private $isMobile = false;
    private $jsIncludeFiles = array();
    private $cssIncludeFiles = array();
    private $headFiles = array();
    
    /**
     * loads the template
     * 
     * @param string $template
     * @param string $theme
     */
    protected function loadTemplate($template, $theme) {
       
        if ($this->agentType['isMobile']) {
            $filepath = __SITE_PATH . "/src/themes/$theme/mobile/$template";
        } else {
            $filepath = __SITE_PATH . "/src/themes/$theme/templates/$template";
        }


        $this->template = file_get_contents($filepath);
    }

    /**
     * calls all the render methods
     */
    protected function renderView() {
       
        if(!array_key_exists('template', $this->config)) {
            throw new \exceptions\YamlKeyNotFoundException('template not set in views configuration');
        }
        $template = $this->config['template'];
        $theme = $this->config['theme'];
        $this->sections = $this->config['sections'];
        
        
        $this->loadTemplate($template, $theme);
        //render widgets before replacing section tags with HTML
        $this->renderWidgets();
        
        //this HAS to be called before the rest
        $this->renderSections();
        
        $this->renderHTMLTags();
        $this->placeHeadJSFiles();
        $this->placeJSFiles();
        $this->placeCSSFiles();
        $this->renderURITags($template);
        
        $this->renderImages();
   
    }

    private function setWidgetConfigs(array $config) {
     
        if(array_key_exists('head', $config) && count($config['head']) > 0) {
            $this->headFiles = array_merge($config['head'], $this->headFiles);
        }
  
        if(array_key_exists('javascript', $config) && count($config['javascript']) > 0 ) {
            $jshandler = new ImportJSHandler($this->logger);
            $parselist = $jshandler->handlerequest($config['javascript']);
            $this->jsIncludeFiles = array_merge($this->jsIncludeFiles, $parselist);
        }
        if(array_key_exists('css', $config) && count($config['css']) > 0) {
            $cssHandler = new ImportCSSHandler($this->logger);
            $parseList = $cssHandler->handlerequest($config['css']);
            $this->cssIncludeFiles = array_merge($this->cssIncludeFiles, $parseList);
        }
    }
    
    /**
     * render the URI tags
     */
    protected function renderURITags() {
        $uriHandler = new URITagHandler($this->logger);

        $uriHandler->setTemplate($this->template);
        $this->template = $uriHandler->handlerequest();
    }

    /**
     * render the HTML tags
     */
    protected function renderHTMLTags() {
        $htmlHandler = new HTMLTagHandler($this->logger);
        $htmlHandler->setDefaultLocale($this->getDefaultLocale());
        $htmlHandler->setTemplate($this->template);
        $this->template = $htmlHandler->handleRequest($this->data);
    }

    

    /**
     * find any JS files to create <script /> tags for
     */
    protected function placeHeadJSFiles() {
        $jsIncludeString = '';
        //remove any duplicates from files calling same includes
        $list = array_unique($this->headFiles);
        
        foreach ($list as $file) {
            $jsIncludeString .= "<script language=\"javascript\" src=\"$file\"></script>\r\n";
        }

        $this->template = str_replace('<!---head--->', $jsIncludeString, $this->template);
    }

    /**
     * find any JS files to create <script /> tags for
     */
    protected function placeJSFiles() {
        $jsIncludeString = '';
        //remove any duplicates from files calling same includes
        $list = array_unique($this->jsIncludeFiles);
        
        foreach ($list as $file) {
            $jsIncludeString .= "<script language=\"javascript\" src=\"$file\"></script>\r\n";
        }

        $this->template = str_replace('<!---javascript--->', $jsIncludeString, $this->template);
    }

    /**
     * find any CSS files to create <script /> tags for
     */
    protected function placeCSSFiles() {
        $cssIncludeString = '';
        //remove any duplicates from files calling same includes
        $list = array_unique($this->cssIncludeFiles);
        
        foreach ($list as $file) {
            $cssIncludeString .= "<link href=\"$file\" rel=\"stylesheet\">\r\n";
        }

        $this->template = str_replace('<!---css--->', $cssIncludeString, $this->template);
    }

    protected function renderWidgets() {
      
        if (is_null($this->httpRequest->getAttribute('SystemWidgets'))) {

            return;
        }
        $widgetList = $this->httpRequest->getAttribute('SystemWidgets');
      
        foreach ($widgetList as $sectionName => $section) {
            
            if (!is_array($section)) {
                if(is_array($subSection)) {
                    $this->setWidgetConfigs($section);
                }
                $filename = (is_array($section) && array_key_exists('file', $section)) ? $section['file'] : $section;
                
                $sectionNamePlaceHolder = '<!---' . $sectionName . '--->';
                $this->template = str_replace($sectionNamePlaceHolder, $this->loadSectionContent($filename) . "\r\n" . $sectionNamePlaceHolder, $this->template);
            } else {              
                foreach ($section as $subSectionName => $subSection) {
                    if(is_array($subSection)) {
                        $this->setWidgetConfigs($subSection);
                    }
                    $filename = (is_array($subSection) && array_key_exists('file', $subSection)) ? $subSection['file'] : $subSection;
                  
                    $sectionNamePlaceHolder = '<!---' . $sectionName . '--->';
                    $this->template = str_replace($sectionNamePlaceHolder, $this->loadSectionContent($filename) . "\r\n" . $sectionNamePlaceHolder, $this->template);
                }
            }
        }
    }
    /**
     * finds all sections within a template and places the appropriate PHP
     * file within that area of the template before rendering all PHP tags
     * 
     * @return void
     */
    protected function renderSections() {

        if (is_null($this->sections)) {

            return;
        }

        foreach ($this->sections as $sectionName => $section) {
            if (!is_array($section)) {
                $sectionNamePlaceHolder = '<!---' . $sectionName . '--->';
                $this->template = str_replace($sectionNamePlaceHolder, $this->loadSectionContent($section), $this->template);
            } else {
                foreach ($section as $subSectionName => $subSection) {
                    $sectionNamePlaceHolder = '<!---' . $subSectionName . '--->';
                    $this->template = str_replace($sectionNamePlaceHolder, $this->loadSectionContent($subSection), $this->template);
                }
            }
        }
    }

    /**
     * loads the PHP 'section' and renders and includes for JS/CSS
     * 
     * @param string $section
     * 
     * @return string
     */
    private function loadSectionContent($section) {

        $sectionContent = file_get_contents(__SITE_PATH . DIRECTORY_SEPARATOR . $section);

        $contentWithHeadJs = $this->renderHeadJs($sectionContent);
        $contentWithJs = $this->renderJs($contentWithHeadJs);

        $contentWithCss = $this->renderCss($contentWithJs);

        if (is_array($contentWithCss)) {
            return implode('', $contentWithCss);
        }

        return $contentWithCss;
    }

 
    /**
     * finds all Head JS include references and calls the handler to do the work
     * 
     * @param string $sectionContent
     * 
     * @return string
     */
    private function renderHeadJs($sectionContent) {

        $frontchunks = explode('<!--- head start --->', $sectionContent);
     
        if (count($frontchunks) < 2 && count($this->headFiles) == 0) {
            return $sectionContent;
        }
        if(count($frontchunks) > 0) {
            $frontchunk = array_shift($frontchunks);

            $backchunks = explode('<!--- head end --->', current($frontchunks));

            $jslist = explode("\n", ($backchunks[0]));

            $this->headFiles = array_merge($jslist, $this->headFiles);
        }

        $jshandler = new ImportJSHandler($this->logger);
        $this->headFiles = $jshandler->handlerequest($this->headFiles);
        //$this->headFiles = array_merge($this->headFiles, $parselist);

        return $frontchunk . (count($backchunks) > 1 ? $backchunks[1] : '');
    }

    /**
     * finds all JS include references and calls the handler to do the work
     * 
     * @param string $sectionContent
     * 
     * @return string
     */
    private function renderJs($sectionContent) {
       
        $frontchunks = explode('<!--- javascript start --->', $sectionContent);
        if (count($frontchunks) < 2) {
            return $frontchunks;
        }

        $frontchunk = array_shift($frontchunks);

        $backchunks = explode('<!--- javascript end --->', current($frontchunks));

        $jslist = explode("\n", ($backchunks[0]));

        $jshandler = new ImportJSHandler($this->logger);
        $parselist = $jshandler->handlerequest($jslist);
        $this->jsIncludeFiles = array_merge($this->jsIncludeFiles, $parselist);

        return $frontchunk . (count($backchunks) > 1 ? $backchunks[1] : '');
    }

    /**
     * finds all CSS include references and calls the handler to do the work
     * 
     * @param string $sectionContent
     * 
     * @return string
     */
    private function renderCss($sectionContent) {
        if (is_array($sectionContent)) {
            $sectionContent = implode('', $sectionContent);
        }

        $frontchunks = explode('<!--- css start --->', $sectionContent);
        if (count($frontchunks) < 2) {
            return $frontchunks;
        }

        $frontchunk = array_shift($frontchunks);

        $backchunks = explode('<!--- css end --->', current($frontchunks));

        $cssList = explode("\n", ($backchunks[0]));

        $cssHandler = new ImportCSSHandler($this->logger);
        $parseList = $cssHandler->handlerequest($cssList);
        $this->cssIncludeFiles = array_merge($this->cssIncludeFiles, $parseList);

        $retval = $frontchunk . $backchunks[1];

        if (is_array($retval)) {
            return implode('', $retval);
        }
        return $retval;
    }

    protected function renderImages() {
        
        //<img src="@components/component-name/includes/images/name-of-another-file.jpg" />
        $handler = new \core\handlers\ImportImageHandler($this->logger);
        $handler->handleRequest(array());
//        $imageList = array();
//        
//        //get the first part of the images list
//        $pieces = explode('<img src="@components/', $this->template);
//        
//        //iterate the list and get the filepath
//        foreach($pieces as $piece) {
//            pr($piece);
//            $imageList[] = '/images/components/' . substr($piece, strpos($piece, '"'));
//        }
//        pr($imageList);
//        die;
//        $this->template = preg_replace('<img src="[\w/\.]+"(\s|)/>', '<img src="\/images\/components', $this->template);
        
    }
}
