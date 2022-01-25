<?php

$route = [

    'web' => [
        '/'         => 'App\Controllers\TaskController::view',

        '/login'   => 'App\Controllers\AuthController::view',
    ],

    'api' => [
        '/api/task/update'  => 'App\Controllers\TaskController::update',
        '/api/task/delete'  => 'App\Controllers\TaskController::delete',
        '/api/task/create'  => 'App\Controllers\TaskController::create',

        '/api/auth/login'   => 'App\Controllers\AuthController::login',
        '/api/auth/logout'  => 'App\Controllers\AuthController::logout',
    ]
];