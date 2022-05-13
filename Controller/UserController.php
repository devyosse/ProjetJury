<?php

use App\Controller\AbstractController;
use App\Model\Manager\RoleManager;
use App\Model\Manager\UserManager;

class UserController extends AbstractController
{
    /**
     * UserController entry point - default action.
     */
    public function index()
    {
        $this->redirectIfNotGranted(RoleManager::ROLE_ADMIN);

        $this->render('user/users-list', [
            'users_list' => UserManager::getAll()
        ]);
    }

    /**
     * Display a specific user information.
     * @param int $id
     * @return void
     */
    public function showUser(int $id)
    {
        if(!UserManager::userExists($id)) {
            $this->index();
        }
        else {
            $this->render('user/show-user', [
                'user' => UserManager::getUser($id),
            ]);
        }
    }


    // TODO
    public function editUser(int $id, string $category) {
        var_dump([
            '$id' => $id,
            '$category' => $category,
        ]);
    }


    /**
     * Route handling users deletion.
     * @param int $id
     * @return void
     */
    public function deleteUser(int $id)
    {
        if(UserManager::userExists($id)) {
            $user = UserManager::getUser($id);
            $deleted = UserManager::deleteUser($user);
        }
        $this->index();
    }


    /**
     * @return void
     */
    public function register()
    {
        self::redirectIfConnected();

        if($this->isFormSubmitted()) {
            $mail = ($this->getFormField('email'));
            $firstname =$this->getFormField('firstname');
            $lastname = $this->getFormField('lastname');
            $password = $this->getFormField('password');
            $passwordRepeat = $this->getFormField('password-repeat');
            $age = (int)$this->getFormField('age', 0);

            $errors = [];
            $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                // l'email n'est pas valide.
                $errors[] = "L'adresse mail n'est pas au bon format";
            }

            if(!strlen($firstname) >= 2) {
                // Le firstname ne fait pas au moins 2 caractères.
                $errors[] = "Le firstname ne fait pas au moins 2 chars";
            }

            if(!strlen($lastname) >= 2) {
                // Le lastname ne fait pas au moins 2 caractères.
                $errors[] = "Le lastname ne fait pas au moins 2 chars";
            }

            if($password !== $passwordRepeat) {
                // Les passwords ne correspondent pas !
                $errors[] = "Les password ne correspondent pas";
            }

            if(!preg_match('/^(?=.*[!@#$%^&*-\])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
                // Le password ne correspond pas au critère.
                $errors[] = "Le password ne correpsond pas au critère";
            }

            if($age <= 18 || $age >= 120) {
                // L'age n'est pas dans la bonne tranche.
                $errors[] = "L'age n'est pas réglementaire";
            }

            // S'il y a une erreur, enregistrement des messages en session.
            if(count($errors) > 0) {
                $_SESSION['errors'] = $errors;
            }
            else {
                //pas d'erreurs, enregistrement.
                $user = new User();
                $role = RoleManager::getRoleByName('user');
                $user
                    ->setAge($age)
                    ->setFirstname($firstname)
                    ->setLastname($lastname)
                    ->setEmail($mail)
                    ->setPassword(password_hash($password, PASSWORD_DEFAULT))
                    ->setRoles([$role])
                ;

                if(!UserManager::userMailExists($user->getEmail())) {
                    UserManager::addUser($user);
                    if(null !== $user->getId()) {
                        $_SESSION['success'] = "Félicitations votre compte est actif";
                        $user->setPassword('');
                        $_SESSION['user'] = $user;
                    }
                    else {
                        $_SESSION['errors'] = ["Impossible de vous enregistrer"];
                    }
                }
                else {
                    $_SESSION['errors'] = ["Cette adresse mail existe déjà !"];
                }
            }

        }
        $this->render('view/User/Inscription.php');
    }


    /**
     * User logout.
     * @return void
     */
    public function logout(): void
    {
        if(self::isUserConnected()) {
            $_SESSION['user'] = null;
            $_SESSION['messages'] = null;
            $_SESSION['success'] = null;
            session_destroy();
        }

        $this->render('index.php');
    }


    /**
     * User login
     * @return void
     */
    public function login()
    {
        self::redirectIfConnected();

        if($this->isFormSubmitted()) {
            $errorMessage = "L'utilisateur / le password est mauvais";
            $mail =$this->getFormField('email');
            $password = $this->getFormField('password');

            $user = UserManager::getUserByMail($mail);
            if (null === $user) {
                $_SESSION['errors'][] = $errorMessage;
            }
            else {
                if (password_verify($password, $user->getPassword())) {
                    $user->setPassword('');
                    $_SESSION['user'] = $user;
                    $this->redirectIfConnected();
                }
                else {
                    $_SESSION['errors'][] = $errorMessage;
                }
            }
        }

        $this->render('view/User/Connexion.php');
    }
}