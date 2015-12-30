<?php

namespace components\scoping\serialization;

use core\serialization\Serializer;

/**
 * Description of MaterialTakeoffSheetSerializer
 *
 * @author Devin
 */
class MaterialTakeoffSheetSerializer extends Serializer {

    public function formatAreaTypes(array $areaTypes, array $sheetItems) {
        $retval = array();
        foreach ($areaTypes as $type) {
            $key = $type['areaType'];
            $id = $type['AffectedAreas_id'];
            foreach ($sheetItems as $item) {
                if ($id == $item['AffectedAreas_id']) {
                    $retval['lineItems'][$key][$item['InventoryItems_id']] = $item;
                }
            }
        }

        return $retval;
    }

}
