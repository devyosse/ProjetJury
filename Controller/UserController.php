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

        $this->render('admin/admin.php', [
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
            $this->render('admin/admin.php', [
                'user' => UserManager::getUser($id),
            ]);
        }
    }


    /**
     * Route handling users deletion.
     * @param int $id
     * @return void
     */
    public function deleteUser(int $id)
    {
        $this->redirectIfNotGranted(RoleManager::ROLE_ADMIN);
        if(UserManager::userExists($id)) {
            $user = UserManager::getUser($id);
            UserManager::deleteUser($user);
        }
        $this->index();
    }


    /**
     * @return void
     */
    public function register()
    {
        self::redirectIfConnected();

        if($this->isFormSubmitted())
        {
            $mail = ($this->getFormField('email'));
            $username =$this->getFormField('username');
            $password = $this->getFormField('password');
            $passwordRepeat = $this->getFormField('password-repeat');
            $age = (int)$this->getFormField('age', 0);

            $errors = [];
            $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                // email not valid
                $errors[] = "L'adresse mail n'est pas au bon format";
            }

            if(!strlen($username) >= 2) {
                //the firstname don't do two character
                $errors[] = "Le firstname ne fait pas au moins 2 chars";
            }

            if($password !== $passwordRepeat) {
                // the password are not similar
                $errors[] = "Les password ne correspondent pas";
            }

            if(!preg_match('/^(?=.*[!@#$%^&*-\])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
                //the password have not similar criteria
                $errors[] = "Le password ne correspond pas au crit??re";
            }

            if($age <= 18 || $age >= 120) {
                // the age are not reglementary
                $errors[] = "L'age n'est pas r??glementaire";
            }

            // if we have mistake, the message are register in the session
            if(count($errors) > 0) {
                $_SESSION['errors'] = $errors;
            }
            else {
                //no mistake, register
                $user = new User();
                $user
                    ->setAge($age)
                    ->setUsername($username)
                    ->setEmail($mail)
                    ->setPassword(password_hash($password, PASSWORD_DEFAULT))
                ;

                $user->setRole(RoleManager::getRoleByName(RoleManager::ROLE_USER));

                if(!UserManager::userMailExists($user->getEmail())) {
                    UserManager::addUser($user);
                    if(null !== $user->getId()) {
                        $_SESSION['success'] = "F??licitations votre compte est actif, vous pouvez vous connecter";
                        $user->setPassword('');
                        $_SESSION['user'] = $user;
                        header('Location: /index.php');
                    }
                    else {
                        $_SESSION['errors'] = ["Impossible de vous enregistrer"];
                    }
                }
                else {
                    $_SESSION['errors'] = ["Cette adresse mail existe d??j?? !"];
                }
            }

        }

        $this->render('user/inscription.php');
    }


    /**
     * user logout.
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

        (new \HomeController())->index();
    }


    /**
     * user login
     * @return void
     */
    public function login()
    {
        self::redirectIfConnected();

        if($this->isFormSubmitted()) {
            $errorMessage = "L'utilisateur / le password est mauvais";
            $mail = $this->getFormField('mail');
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

        $this->render('user/connexion.php');
    }
}