<?php

return [
    'GET'  => [
        '/users/new'       => ['user', 'index'],
        '/users'           => ['user', 'show'],
        '/users/edit/{id}' => ['user', 'edit']
    ],
    'POST' => [
        '/users/create'      => ['user', 'create'],
        '/users/update/{id}' => ['user', 'update'],
        '/users/{id}'        => ['user', 'delete'],
    ]
];
