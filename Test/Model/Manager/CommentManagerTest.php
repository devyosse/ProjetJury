<?php

use App\Manager\CommentManager;
use PHPUnit\Framework\TestCase;

require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../Model/Entity/AbstractEntity.php';
require __DIR__ . '/../../../Model/Entity/User.php';
require __DIR__ . '/../../../Model/Entity/Role.php';
require __DIR__ . '/../../../Model/Entity/Product.php';
require __DIR__ . '/../../../Model/Entity/Comment.php';
require __DIR__ . '/../../../Model/Database.php';
require __DIR__ . '/../../../Model/Manager/UserManager.php';
require __DIR__ . '/../../../Model/Manager/ProductManager.php';
require __DIR__ . '/../../../Model/Manager/RoleManager.php';
require __DIR__ . '/../../../Model/Manager/CommentManager.php';

class CommentManagerTest extends TestCase
{

    public function testGetComments(): void
    {
        $comments = CommentManager::getComments();
        $this->assertIsArray($comments);
        foreach ($comments as $comment) {
            $this->assertIsInt($comment->getAuthor()->getId());
            $this->assertIsInt($comment->getProduct()->getId());
            $this->assertIsString($comment->getContent());
    }
    }
}