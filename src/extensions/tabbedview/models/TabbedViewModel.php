<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace extensions\tabbedview\models;

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
class TabbedViewModel extends AbstractModel implements FormBuilderInterface{

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
     * 
     * 
     * @param string $view  tabbed|html ...
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

    public function getFormWrapper() {
        return $this->entity;
    }

}
