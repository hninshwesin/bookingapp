<?php

/**
 * @see https://github.com/Edujugon/PushNotification
 */

return [
    'gcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'My_ApiKey',
    ],
    'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'AAAA32xtX0A:APA91bF8K083FO_FlmuauDW4dVAfwiT7Ti5R02HyQTl74ZD8xQQZBGzb0aSldh5EEBwsnwO2kQk3Jnq6buftjk_SaFbNVDyTO-HhXziOQK4TkIlE6VWvG3FF_bkaqE5GcHLDrU3n09aP',
    ],
    'apn' => [
        'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
        'passPhrase' => 'secret', //Optional
        'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
        'dry_run' => true,
    ],
];
