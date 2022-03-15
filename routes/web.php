<?php
    require_once '../app/Controllers/UserController.php';
    require_once '../app/Controllers/BaseController.php';

    require_once '../app/Router/Router.php';
    require_once "../routes/api.php";

    $router->get('/', [new BaseController, 'index']);

    $router->addNotFoundHandler([new BaseController, 'error']);
    $router->run();
