<?php

namespace App\Controller;


use ProductManager;
use App\Model\Manager\UserManager;
use Product;

class ProductController extends AbstractController
{
    public function index()
    {

    }

    public function listAllArticles()
    {

    }

    /**
     * Route to add a new product.
     * @return void
     */
    public function addProduct()
    {
        self::redirectIfNotConnected();

        if($this->isFormSubmitted()) {

            // Getting Product data from form.
            $title = $this->$this->getFormField('title');
            $content = $this->$this->getFormField('content');

            // Create a new Product entity (no persisted).
            $article = new Product();
            $article
                ->setTitle($title)
                ->setContent($content)
                ->setAuthor($admin)
            ;

            // Saving new product
            if(ProductManager::addNewProduct($product)) {
                $this->render('admin/show-product', [
                    'article' => $article,
                ]);
            }
        }

        $this->render('article/add-product');
    }


}
