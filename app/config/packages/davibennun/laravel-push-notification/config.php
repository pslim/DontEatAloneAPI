<?php

return array(
    // IOS currently not used
    'appNameIOS'     => array(
        'environment' =>'development',
        'certificate' =>'/path/to/certificate.pem',
        'passPhrase'  =>'password',
        'service'     =>'apns'
    ),
    'appNameAndroid' => array(
        'environment' =>'production',
        'apiKey'      =>'AIzaSyAFw68XnhNim2zUyefbtsZlfqNdw4K8PyA',
        'service'     =>'gcm'
    )

    //Sender ID: 404441292869
);