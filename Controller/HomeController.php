<?php

use App\Controller\AbstractController;
use App\Manager\CommentManager;

class HomeController extends AbstractController
{
    /**
     * Home page
     * @return void
     */
    public function index()
    {
        $this->render('home/home.php', [
            'products' => ProductManager::getAllProducts(),
            'comments' => CommentManager::getComments(),
        ]);
    }
}

