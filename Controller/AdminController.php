<?php


use App\Controller\AbstractController;

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
}

