<?php


use App\Controller\AbstractController;
use App\Model\Manager\RoleManager;
use App\Model\Manager\UserManager;

class AdminController extends AbstractController
{
    /**
     * Admin page
     * @return void
     */
    public function index()
    {
        $allUsers = [];
        $users = UserManager::getAll();
        foreach ($users as $user) {
            if($user->getRole()->getRoleName() === RoleManager::ROLE_USER) {
                $allUsers[] = $user;
            }
        }
        $this->render('admin/admin.php', [
            'users_list' => $allUsers,
        ]);
    }
}

