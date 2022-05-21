<?php


use App\Routing\AbstractRouter;
use App\Routing\HomeRouter;
use App\Routing\UserRouter;

require __DIR__ . '/includes.php';


session_start();

$page = isset($_GET['c']) ? AbstractRouter::secure($_GET['c']) : null;
if($page === null) {
    $page = 'home';
}

$method = isset($_GET['a']) ? AbstractRouter::secure($_GET['a']) : null;
if($method === null) {
    $method = 'index';
}


// Defining the right controller.

switch ($page) {
    case 'home':
        HomeRouter::route();
        break;
    case 'user':
        UserRouter::route($method);
        break;
    case 'product':
        ProductRouter::route($method);
        break;
    case 'admin':
        AdminRouter::route($method);
        break;
    default:
        (new ErrorController())->error404($page);
}

