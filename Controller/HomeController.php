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

// TODO => Rechercher les téléphones dans la base de données et les envoyer vers la home page.