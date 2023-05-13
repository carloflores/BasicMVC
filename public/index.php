<?php

require_once '../core/Controller.php';
require_once '../core/Router.php';
require_once '../core/Database.php';
require_once '../core/Model.php';

$router = new Router();

$router->loadRoutes('../routes/web.php');
$router->loadRoutes('../routes/api.php', 'api');

$router->dispatch();