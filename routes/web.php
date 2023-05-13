<?php

return [
    'get' => [
        '' => 'HomeController@index',
        'about' => 'AboutController@index',
        // ... other GET routes ...
    ],
    'post' => [
        'form' => 'FormController@submit',
        // ... other POST routes ...
    ],
];