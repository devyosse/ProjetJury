<?php




require __DIR__ . "/Partials/header.php";
require __DIR__ . "/Partials/footer.php";

require __DIR__ . '/Model/Database.php';
require __DIR__ . '/Model/Entity/AbstractEntity.php';
require __DIR__ . '/Model/Entity/Product.php';
require __DIR__ . '/Model/Entity/Comment.php';
require __DIR__ . '/Model/Entity/Role.php';
require __DIR__ . '/Model/Entity/User.php';

require __DIR__ . '/Model/Manager/RoleManager.php';
require __DIR__ . '/Model/Manager/UserManager.php';
require __DIR__ . '/Model/Manager/CommentManager.php';
require __DIR__ . '/Model/Manager/ProductManager.php';