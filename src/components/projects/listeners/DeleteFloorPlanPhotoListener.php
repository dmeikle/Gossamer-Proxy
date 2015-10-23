<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\projects\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;

/**
 * Description of UploadLocationPhotosListener
 *
 * @author Dave Meikle
 */
class DeleteFloorPlanPhotoListener extends AbstractListener {

    public function on_delete_success(Event $event) {

        $params = $event->getParams();

        if (!is_array($params) || !array_key_exists('ProjectAddresssFloorPlan', $params)) {
            return;
        }

        $floorPlan = current($params['ProjectAddresssFloorPlan']);
        $projectId = $floorPlan['ProjectAddresses_id'];
        $filename = $floorPlan['floorPlan'];

        $filepath = __SITE_PATH . "/web/images/floorplans/$projectId";

        @unlink($filepath . DIRECTORY_SEPARATOR . $filename);
        @unlink($filepath . DIRECTORY_SEPARATOR . "thumbs/" . $filename);
    }

}
