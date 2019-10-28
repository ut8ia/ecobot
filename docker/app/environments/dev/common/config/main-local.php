<?php

return [
        'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=ecobot_db;dbname=ecotower',
                'username' => 'walker',
                'password' => 'example',
                'charset' => 'utf8',
            ]
        ],
    ];
