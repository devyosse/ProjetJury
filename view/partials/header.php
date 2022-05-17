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

    if(isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);

        foreach($errors as $error) {?>
            <div class="error-message">
                <?= $error ?>
            </div><?php
        }
    }
    ?>
    <nav class="nav-bar">
        <a href="/index.php?c=home&a=home" title="Accueil" id="home">Accueil</a><?php

        if(!AbstractController::isUserConnected()) { ?>
            <a href="/index.php?c=user&a=register" title="Inscrivez vous" class="register">Inscription</a>
            <a href="/index.php?c=user&a=login" title="Connectez vous" class="login">Connexion</a> <?php
        }

        if(AbstractController::isUserConnected()) { ?>
            <a href="/index.php?c=user&a=logout" title="Déconnexion" class="login">Déconnexion</a> <?php
        }?>

    </nav>
