<?php

return array(
    // IOS currently not used
    'dontEatAloneIOS'     => array(
        'environment' =>'development',
        'certificate' =>'/path/to/certificate.pem',
        'passPhrase'  =>'password',
        'service'     =>'apns'
    ),
    'dontEatAloneAndroid' => array(
        'environment' =>'production',
        'apiKey'      =>'AIzaSyAfSQbgMkPCd2YVzd_-p3SUQSOdUDQgcbo',
        'service'     =>'gcm'
    )

);