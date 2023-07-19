<?php

return [
    'GET'  => [
        '/users/new'       => ['user', 'new'],
        '/users'           => ['user', 'index'],
        '/users/edit/{id}' => ['user', 'edit']
    ],
    'POST' => [
        '/users/create'      => ['user', 'create'],
        '/users/update/{id}' => ['user', 'update'],
        '/users/{id}'        => ['user', 'delete']
    ]
];
