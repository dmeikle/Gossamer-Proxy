<?php

$message = array(
    'template' => 'BASIC_EMAIL',
    'recipientType' => 'Staff',
    'recipientId' => '2',
    'subject' => 'this is a test email',
    'message' => 'this java proxy totally rocks!'
);

$pdf = array(
    array('name' => 'CONTRACTOR_REPORT',
        'params' => array(
            'Claims_id' => '212'
        )
    ),
    array('name' => 'HYDRO_USAGE_BILL',
        'params' => array(
            'Claims_id' => '212',
            'ClaimsLocations_id' => '240'
        )
    )
);


$package = array(
    'EMAIL_WITH_ATTACHMENTS' => array(
        'message' => $message,
        'pdf' => $pdf
    )
);

echo json_encode($package);
?>