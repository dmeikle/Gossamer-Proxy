<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\eventlisteners;

use libraries\utils\preferences\UserPreferencesManager;

/**
 * loads the default preferences for any user requests where we don't know
 * who they are. things like langage to use (en_US) etc...
 * 
 * @author Dave Meikle
 */
class LoadUserPreferencesListener extends AbstractListener {

    /**
     * 
     * @param type $params
     */
    public function on_entry_point($params) {
        $manager = new UserPreferencesManager($this->httpRequest);
        $userPreferences = $manager->getPreferences();
        
        if(strlen($userPreferences->getViewType()) > 0) {
            $this->httpRequest->setAttribute('UserPreferences', $userPreferences);
        }
    }

}
