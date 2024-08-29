<?php

return [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
        'site/*',
        'setting/*',
        'admin/*',
        'comment/*',
        'gii/*',
        'array/*',
        'api/*',
        'excel/*',
        'debug/*',
        'some-controller/some-action',
    ],
];