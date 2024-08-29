<?php

return [
    'class' => \yii\symfonymailer\Mailer::class,
    'viewPath' => '@app/mail',
    'transport' => [
        'dsn' => 'smtp://9c86b21594a49d:b3358434a566f6@sandbox.smtp.mailtrap.io:2525'
    ],
];
