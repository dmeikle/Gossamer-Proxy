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

    private $sections = null;
    private $isMobile = false;
    private $jsIncludeFiles = array();
    private $cssIncludeFiles = array();

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

    /**
     * render the URI tags
     */
    private function renderURITags() {
        $uriHandler = new URITagHandler($this->logger);

        $uriHandler->setTemplate($this->template);
        $this->template = $uriHandler->handlerequest();
    }

    /**
     * render the HTML tags
     */
    private function renderHTMLTags() {
        $htmlHandler = new HTMLTagHandler($this->logger);
        $htmlHandler->setDefaultLocale($this->getDefaultLocale());
        $htmlHandler->setTemplate($this->template);
        $this->template = $htmlHandler->handleRequest($this->data);
    }

    /**
     * find any JS files to create <script /> tags for
     */
    private function placeJSFiles() {
        $jsIncludeString = '';

        foreach ($this->jsIncludeFiles as $file) {
            $jsIncludeString .= "<script language=\"javascript\" src=\"$file\"></script>\r\n";
        }

        $this->template = str_replace('<!---javascript--->', $jsIncludeString, $this->template);
    }

    /**
     * find any CSS files to create <script /> tags for
     */
    private function placeCSSFiles() {
        $cssIncludeString = '';

        foreach ($this->cssIncludeFiles as $file) {
            $cssIncludeString .= "<link href=\"$file\" rel=\"stylesheet\">\r\n";
        }

        $this->template = str_replace('<!---css--->', $cssIncludeString, $this->template);
    }

    /**
     * finds all sections within a template and places the appropriate PHP
     * file within that area of the template before rendering all PHP tags
     * 
     * @return void
     */
    private function renderSections() {

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

        $contentWithJs = $this->renderJs($sectionContent);

        $contentWithCss = $this->renderCss($contentWithJs);

        if (is_array($contentWithCss)) {
            return implode('', $contentWithCss);
        }

        return $contentWithCss;
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
        $this->jsIncludeFiles = $parselist;

        return $frontchunk .
                $backchunks[1];
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
        $this->cssIncludeFiles = $parseList;

        $retval = $frontchunk . $backchunks[1];

        if (is_array($retval)) {
            return implode('', $retval);
        }
        return $retval;
    }

}
