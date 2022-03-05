<?php
    require_once '../app/Controllers/UserController.php';
    require_once '../app/Controllers/BaseController.php';

    require_once '../app/Router/Router.php';

    $router = new Router;

    // $router->get('/', [new BaseController, 'index']);
    $router->get('/show-user', [new UserController, 'show']);
    $router->post('/user', [new UserController, 'create']);

    $router->addNotFoundHandler([new BaseController, 'error']);
    $router->run();

    
    