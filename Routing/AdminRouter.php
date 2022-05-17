<?php

use App\Routing\AbstractRouter;

class AdminRouter extends AbstractRouter
{
    /**
     * @return void
     */
    public static function route(?string $action = null)
    {
        (new AdminController())->index();
    }

}