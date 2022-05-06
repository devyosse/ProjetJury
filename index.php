<?php
require __DIR__ . './includes.php';


session_start();

$page = AbstractRouter::secure($_GET['c']) ?? 'home';
$method = AbstractRouter::secure($_GET['a']) ?? 'index';

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
    default:
        (new ErrorController())->error404($page);
}

