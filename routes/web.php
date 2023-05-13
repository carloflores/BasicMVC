<?php

// routes.php
return [
    'GET' => [
        '' => 'TaskController@index',
        'tasks/create' => 'TaskController@create',
        'tasks/{id}' => 'TaskController@show',
        'tasks/{id}/edit' => 'TaskController@edit',
    ],
    'POST' => [
        'tasks' => 'TaskController@store',
        'tasks/{id}' => 'TaskController@update',
        'tasks/{id}/delete' => 'TaskController@delete',
    ],
];