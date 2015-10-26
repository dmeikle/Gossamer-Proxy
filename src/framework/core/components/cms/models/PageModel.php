<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\cms\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use Gossamer\CMS\Forms\FormBuilderInterface;

/**
 * Model for the Page
 *
 * @author Dave Meikle
 */
class PageModel extends AbstractModel implements FormBuilderInterface {

    /**
     *
     * @param HTTPRequest $httpRequest
     * @param HTTPResponse $httpResponse
     * @param Logger $logger
     */
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'CmsPage';
        $this->tablename = 'cmspages';
    }

    /**
     * used for passing a completely empty page in on first use
     *
     * @param int $id
     * @return array
     */
    public function getArray($id) {
        $locales = $this->httpRequest->getAttribute('locales');
        $keys = array_keys($locales);

        $localesList = array();
        foreach ($keys as $key) {
            $localesList[$key] = array(
                'content' => '',
                'metaTitle' => ''
            );
        }

        return array(
            array('id' => intval($id),
                'CmsCategories_id' => '0',
                'name' => '',
                'summary' => '',
                'permalink' => '',
                'isPublished' => '',
                'isPublic' => '',
                'locales' => $localesList
        ));
    }

    /**
     * search for a page based on keyword to see if it already exists
     * while we are creating/editing a page - avoids name collisions
     *
     * @param int $id
     *
     * @return array(boolean)
     */
    public function search($id) {
        $data = $this->httpRequest->getPost();

        $result = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $data);

        if (!is_array($result) || count($result) == 0) {
            return array('result' => false);
        }

        //maybe we've found ourself... check the id
        $item = current($result['Page']);

        return array('result' => ($item['id'] != $id));
    }

    /**
     * saves a permalink on custom edit
     * //TODO: not yet implemented
     *
     * @return array(true)
     */
    public function savePermalink() {
        $data = $this->httpRequest->getPost();

        //$result = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $data);

        return array('result' => true);
    }

    /**
     * save a page after editing
     *
     * @param int $id
     *
     * @return array(true)
     */
    public function save($id) {
        $data = $this->httpRequest->getPost();
        $data[$this->entity]['id'] = intval($id);
        $data[$this->entity]['Staff_id'] = $this->getLoggedInStaffId();
        //$data[$this->entity]['lastModified'] = 'null';
        if ($data[$this->entity]['CmsSections_id'] == 0) {
            $data[$this->entity]['CmsSections_id'] = 'null';
        }
        $result = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $data[$this->entity]);

        return array('result' => true);
    }

    /**
     * preview a page before saving
     * //TODO: not yet implemented
     *
     * @param type $id
     * @return array
     */
    public function preview($id) {
        $data = array('id' => intval($id));

        $result = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $data);

        if (!is_array($result)) {
            $result = array();
        }

        return $result;
    }

    /**
     * load a page for editing
     *
     * @param int $id
     *
     * @return array
     */
    public function edit($id) {

        $params = array(
            'id' => intval($id)
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        $data['sections'] = $this->httpRequest->getAttribute('Sections');
        $categoryID = array_key_exists('CmsCategories_id', $data) ? $data['CmsCategories_id'] : '0';

        $data['sectionOptionsList'] = $this->formatSelectionBoxOptions($this->httpRequest->getAttribute('CmsSections'), array($categoryID), 'sectionName');

        if (!array_key_exists('CmsPage', $data)) {
            $data['CmsPage'] = $this->getArray($id);
        }

        return current($data['CmsPage']);
    }

    /**
     * load a page by its permalink value
     *
     * @param type $section1
     * @param type $section2
     * @param type $section3
     * @return array
     *
     * @throws \Exception
     */
    public function viewByPermalink($section1, $section2 = '', $section3 = '') {
        $item = $this->httpRequest->getAttribute('components\cms\models\PageModel');

        if (is_array($item) && count($item) > 0) {
            return array('CmsPage' => array($item));
        }
        $locale = $this->getDefaultLocale();

        if (strlen($section3) > 0) {
            $params = array('permalink' => $section3, 'CmsSectionsI18n.name' => $section2, 'locale' => $locale['locale']);
        } elseif (strlen($section2) > 0) {
            $params = array('permalink' => $section2, 'CmsSectionsI18n.name' => $section1, 'locale' => $locale['locale']);
        } else {
            $params = array('permalink' => $section1, 'locale' => $locale['locale']);
        }

        $data = $this->dataSource->query(self::METHOD_GET, $this, 'getByPermalink', $params);
        if (!is_array($data) || count($data) == 0) {
            throw new \Exception('Page Content Not Found');
        }

        return $data;
    }

    /**
     *
     * @return string
     */
    public function getFormWrapper() {
        return $this->entity;
    }

}
