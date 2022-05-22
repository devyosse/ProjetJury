<?php
namespace App\Controller;

use App\Model\Entity\Role;
use App\Model\Manager\RoleManager;


abstract class AbstractController
{
    abstract public function index();

    /**
     * @param string $template
     * @param array $data
     * @return void
     */
    public function render(string $template, array $data = [])
    {
        require __DIR__ . "/../view/partials/header.php";
        require __DIR__ . '/../view/' . $template;
        require __DIR__ . "/../view/partials/footer.php";
        exit;
    }


    /**
     * Return true if a form were submitted.
     * @return bool
     */
    public function isFormSubmitted(): bool
    {
        return isset($_POST['send-form']);
    }


    /**
     * Return a form field value or default
     * @param string $field
     * @param $default
     * @return string
     */
    public function getFormField(string $field, $default = null): string
    {
        if (!isset($_POST[$field])) {
            return (null === $default) ? '' : $default;
        }

        return $_POST[$field];
    }


    /**
     * @return bool
     */
    public static function isUserConnected(): bool
    {
        return isset($_SESSION['user']) && null !== ($_SESSION['user'])->getId();
    }

    /**
     * Check if user is admin.
     * @return bool
     */
    public static function isUserAdmin(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']->getRole()->getRoleName() === RoleManager::ROLE_ADMIN;
    }


    /**
     * @return void
     */
    public function redirectIfNotConnected(): void
    {
        if (!self::isUserConnected()) {
            (new \HomeController())->index();
        }
    }

    /**
     * @return void
     */
    public function redirectIfConnected(): void
    {
        if (self::isUserConnected()) {
            (new \HomeController())->index();
        }
    }


    /**
     * @param string $role
     * @return void
     */
    public function redirectIfNotGranted(string $role): void
    {
        if (!self::isUserConnected() || $role !== ($_SESSION['user'])->getRole()->getRoleName()) {
            (new \HomeController())->index();
        }
    }
}