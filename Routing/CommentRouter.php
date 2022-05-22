<?php

use App\Routing\AbstractRouter;

class CommentRouter extends AbstractRouter
{

    public static function route(?string $action = null)
    {
        $controller = new CommentController();
        switch($action) {
            case 'add-comment':
                $controller->addComment();
                break;
            case 'delete-comment':
                self::execRouteWithParameters($controller, 'deleteComment', ['id' => 'int']);
                break;
            case 'edit-comment':
                self::execRouteWithParameters($controller, 'editComment', ['id' => 'int']);
                break;
            default:
                (new ErrorController())->error404($action);
        }
    }
}