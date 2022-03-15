<?php
    require_once '../app/Controllers/UserController.php';
    require_once '../app/Controllers/BaseController.php';

    require_once '../app/Router/Router.php';

    $router = new Router;

    $router->get('/api/show-user', [new UserController, 'show']);
    $router->post('/api/user', [new UserController, 'create']);
    $router->post('/api/user/{id}', [new UserController, 'single']);


    
    