<?php


use App\Controller\AbstractController;
use App\Model\Manager\RoleManager;
use App\Model\Manager\UserManager;
use App\Routing\AbstractRouter;

class AdminController extends AbstractController
{
    /**
     * Admin page
     * @return void
     */
    public function index()
    {
        $this->render('admin/admin.php');
    }


    /**
     * Show users list.
     * @return void
     */
    public function showUsersList()
    {
        $allUsers = [];
        $users = UserManager::getAll();
        foreach ($users as $user) {
            if($user->getRole()->getRoleName() === RoleManager::ROLE_USER) {
                $allUsers[] = $user;
            }
        }
        $this->render('admin/users.php', [
            'users_list' => $allUsers,
        ]);
    }


    /**
     * Show all products list.
     * @return void
     */
    public function showProductsList()
    {
        $this->render('admin/products.php', [
            'products' => ProductManager::getAllProducts()
        ]);
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


    /**
     * Edit a product
     * @param int $id
     * @return void
     */
    public function editProduct(int $id)
    {
        $this->redirectIfNotGranted(RoleManager::ROLE_ADMIN);
        $product = ProductManager::getProduct($id);

        if($this->isFormSubmitted()) {
            if(!isset($_POST['name'], $_POST['content'], $_POST['date_release'])) {
                $_SESSION['errors'][] = "Tous les champs doivent être remplis";
            }

            $name = AbstractRouter::secure($_POST['name']);
            $content = AbstractRouter::secure($_POST['content']);
            $dateRelease = AbstractRouter::secure($_POST['date_release']);

            if(strlen($name) > 2 && strlen($content) > 2 && strlen($dateRelease) > 2) {
                $product->setName($name);
                $product->setContent($content);
                if (DateTime::createFromFormat('Y-m-d', $dateRelease) === false) {
                    $_SESSION['errors'][] = "Le format de date n'est pas correct";
                }

                $product->setDateRelease($dateRelease);
            }
            else {
                $_SESSION['errors'][] = "Les champs doivent avoir du contenu";
            }

            if(!isset($_SESSION['errors'])) {
                ProductManager::updateProduct($product);
                $_SESSION['success'][] = "Produit mis à jour";
            }
        }


        $this->render('admin/edit-product.php', [
            'product' => $product,
        ]);
    }


    /**
     * Delete a product
     * @param int $id
     * @return void
     */
    public function deleteProduct(int $id)
    {
        $this->redirectIfNotGranted(RoleManager::ROLE_ADMIN);

        $this->render('admin/products.php');
    }
}
