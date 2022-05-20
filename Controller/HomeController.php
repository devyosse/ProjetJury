<?php

use App\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Home page
     * @return void
     */
    public function index()
    {
        $this->render('home/home.php', [
            'products' => ProductManager::getAllProducts()
        ]);
    }
}

// TODO => Rechercher les téléphones dans la base de données et les envoyer vers la home page.