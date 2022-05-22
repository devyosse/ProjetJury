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
                $controller->showUsersList();
                break;
            case 'show-products':
                $controller->showProductsList();
                break;
            case 'add-product':
                $controller->addProduct();
                break;
            case 'edit-product':
                self::execRouteWithParameters($controller, 'editProduct', ['id' => 'int']);
                break;
            case 'delete-product':
                self::execRouteWithParameters($controller, 'deleteProduct', ['id' => 'int']);
                break;
            default:
                (new ErrorController())->error404($action);
        }
    }
}
