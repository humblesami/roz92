<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'rDv99bXqaHiMXxfx1bWyxRpeVCaks7fv',
        ],
    ],
];

if (!YII_ENV_TEST) {

}

return $config;
