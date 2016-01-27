<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace components\claims\serialization;

use core\serialization\Serializer;

/**
 * Description of ClaimDocumentSerializer
 *
 * @author Devin
 */
class ClaimDocumentSerializer extends Serializer {

    public function groupDocuments(array $documents) {
        $retval = array();

        if (count($documents) !== 0) {
            foreach ($documents as $document) {
//                pr($document);
                if (array_key_exists('unitNumber', $document)) {
                    //                $retval[$document['unitNumber']][] = $document;
                    $retval[$document['unitNumber']][$document['type']][] = $document;
                } else {
                    if (array_key_exists('type', $document)) {
                        $retval[$document['type']][] = $document;
                    }
                }
            }
        }
        return $retval;
    }

}
