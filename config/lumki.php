<?php

return [
    "prefix" => 'lumki',
    "middleware" => ['web','auth:sanctum'], /*,'can:Manage Users'*/
    'custom_fields' => [
        // [
        //     'type' => 'text',
        //     'name' => 'username',
        //     'label' => 'Username',
        //     'placeholder' => 'Username',
        // ],
    ]
];
