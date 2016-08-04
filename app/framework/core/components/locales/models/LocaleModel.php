<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\locales\models;

use core\AbstractModel;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use Monolog\Logger;
use libraries\utils\preferences\UserPreferences;
use libraries\utils\preferences\UserPreferencesManager;

/**
 * Model for the Locales table
 *
 * @author Dave Meikle
 */
class LocaleModel extends AbstractModel {

    /**
     *
     * @param HTTPRequest $httpRequest
     * @param HTTPResponse $httpResponse
     * @param Logger $logger
     */
    public function __construct(HTTPRequest $httpRequest, HTTPResponse $httpResponse = null, Logger $logger) {
        parent::__construct($httpRequest, $httpResponse, $logger);

        $this->childNamespace = str_replace('\\', DIRECTORY_SEPARATOR, __NAMESPACE__);

        $this->entity = 'Locale';
        $this->tablename = 'locales';
    }

    /**
     * changes the locale and stores it in an encrypted cookie
     */
    public function change($locale = null) {

        //$this->setDefaultLocale($params['locale']);
        $this->setDefaultLocaleCookie($locale);
    }

    /**
     * stores the default locale in session
     *
     * @param string $locale - en_US, zh_CN ...
     */
    public function setDefaultLocale($locale) {

        $userPreferences = getSession('userPreferences');

        if (is_null($userPreferences) || !is_array($userPreferences)) {
            $userPreferences = array();
        }

        $locales = $this->httpRequest->getAttribute('locales');
        $userPreferences['DefaultLocale'] = $locales[$locale];

        setSession('userPreferences', $userPreferences);
    }

    /**
     * stores the default locale in a cookie
     *
     * @param string $locale - en_US, zh_CN ...
     */
    private function setDefaultLocaleCookie($locale) {

        $manager = new UserPreferencesManager($this->httpRequest);
        $userPreferences = $manager->getPreferences();

        if (is_null($userPreferences) || !$userPreferences instanceof UserPreferences) {
            $userPreferences = new UserPreferences;
        }

        $userPreferences->setDefaultLocale($locale);

        $manager->savePreferences($userPreferences->toArray());
    }



    /**
     * saves a locale to the db
     *
     * @param int $id
     */
    public function save(array $params, $customVerb = null) {

        $params = $this->httpRequest->getPost();

        return $this->dataSource->query(self::METHOD_POST, $this, self::VERB_SAVE, $params['Locale']);

    }

}
