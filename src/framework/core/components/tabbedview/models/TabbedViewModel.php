<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\tabbedview\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use libraries\utils\preferences\UserPreferences;
use libraries\utils\preferences\UserPreferencesManager;
use Gossamer\CMS\Forms\FormBuilderInterface;

/**
 * Model for the TabbedView table
 *
 * @author Dave Meikle
 */
class TabbedViewModel extends AbstractModel implements FormBuilderInterface {

    /**
     *
     * @param HTTPRequest $httpRequest
     * @param HTTPResponse $httpResponse
     * @param Logger $logger
     */
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse = null, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'TabbedView';
        $this->tablename = 'staffpreferences';
    }

    /**
     * changes the locale and stores it in an encrypted cookie
     */
    public function change($view = null) {
        $params = array(
            'Staff_id' => $this->getLoggedInStaffId(),
            'viewType' => $view
        );

        $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params);
        $this->setDefaultViewCookie($view);

        return true;
    }

    /**
     * stores the default view in session
     *
     * @param string $view (tabbed/html)
     */
    public function setDefaultView($view) {

        $userPreferences = getSession('userPreferences');

        if (is_null($userPreferences) || !is_array($userPreferences)) {
            $userPreferences = array();
        }

        $userPreferences['DefaultView'] = $view;

        setSession('userPreferences', $userPreferences);
    }

    /**
     * stores the default locale in a cookie
     *
     * @param string $locale - en_US, zh_CN ...
     */
    private function setDefaultViewCookie($view) {

        $manager = new UserPreferencesManager($this->httpRequest);
        $userPreferences = $manager->getPreferences();

        if (is_null($userPreferences) || !$userPreferences instanceof UserPreferences) {
            $userPreferences = new UserPreferences;
        }

        $userPreferences->setViewType($view);

        $manager->savePreferences($userPreferences->toArray());
    }

    /**
     * list all locales
     *
     * @param type $offset
     * @param type $rows
     * @param type $customVerb
     */
    public function listall($offset = 0, $rows = 20, $customVerb = null, array $params = null) {

        $params = array(
            //'directive::OFFSET' => $offset, 'directive::LIMIT' => $limit, 'directive::ORDER_BY' => 'Products.id asc'
            'directive::OFFSET' => $offset, 'directive::LIMIT' => $rows
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_LIST, $params);

        if (array_key_exists(ucfirst($this->tablename) . 'Count', $data)) {
            $data['pagination'] = $this->getPagination($data[ucfirst($this->tablename) . 'Count'], $offset, $rows);
        }

        return $data;
    }

    /**
     * loads a locale for editing
     *
     * @param int $id
     */
    public function edit($id) {

        $params = array(
            'id' => intval($id)
        );

        $data = $this->dataSource->query(self::METHOD_GET, $this, self::VERB_GET, $params);
        $data['thumbnails'] = $this->getFileList(__SITE_PATH . "/images/flags/");

        $this->render($data);
    }

    /**
     * saves a locale to the db
     *
     * @param int $id
     */
    public function save($id) {

        $params = $this->httpRequest->getPost();
        $params['Locale']['id'] = intval($id);

        $data = $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['Locale']);

        return $data;
    }

    public function getFormWrapper() {
        return $this->entity;
    }

}
