<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/Asset/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung</title>
</head>
<body>
    <?php

    use App\Controller\AbstractController;

    // Error messages.
    if(isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);

        foreach($errors as $error) {?>
            <div class="error-message">
                <?= $error ?>
            </div><?php
        }
    }

    // Success messages
    if(isset($_SESSION['success'])) {
        $successes = $_SESSION['success'];
        unset($_SESSION['success']);

        foreach($successes as $success) {?>
            <div class="success-message">
            <?= $success ?>
            </div><?php
        }
    }
    ?>
    <nav class="nav-bar">
        <a href="/index.php" title="Accueil" id="home">Accueil</a><?php

        if(!AbstractController::isUserConnected()) { ?>
            <a href="/index.php?c=user&a=register" title="Inscrivez vous" class="register">Inscription</a>
            <a href="/index.php?c=user&a=login" title="Connectez vous" class="login">Connexion</a> <?php
        }

        if(AbstractController::isUserConnected()) { ?>
            <a href="/index.php?c=user&a=logout" title="Déconnexion" class="login">Déconnexion</a> <?php
        }

        if (AbstractController::isUserAdmin()){ ?>
            <a href="/index.php?c=admin" title="Admin" class="admin">Administration</a> <?php
        } ?>
    </nav>

    <main>
