<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . '127.0.0.1:3306' . ';dbname=' . 'comissao',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'on afterOpen' => function($event) { 
        $event->sender->createCommand("SET time_zone='-03:00';")->execute(); 
    },

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
