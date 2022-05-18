<?php

use App\Routing\AbstractRouter;

class AdminRouter extends AbstractRouter
{
    /**
     * @return void
     */

    public static function route(?string $action = null)
    {
        $controller = new AdminController();
        switch($action) {
            case 'index':
                $controller->index();
                break;
            case 'show-users':
                self::execRouteWithParameters($controller, 'showUsersList', []);
                break;
            case 'show-products':
                self::execRouteWithParameters($controller, 'showProductsList', []);
                break;
            default:
                (new ErrorController())->error404($action);
        }
    }
}