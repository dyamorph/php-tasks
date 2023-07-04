<?php

return [
    'GET' => [
        '/users/new' => ['user', 'new'],
        '/users' => ['user', 'all']
    ],
    'POST' => [
        '/users/create' => ['user', 'create']
    ]
];