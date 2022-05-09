<?php

if (isset($_GET['success']) && intval($_GET['success']) === 1){ ?>
    <div class="success">Les données ont bien été envoyées, merci !</div> <?php
}elseif (isset($_GET['success']) && intval($_GET['success']) === 0) {?>
    <div class="error">Une erreur s'est produite lors du traitement des données ! </div> <?php
}elseif(isset($_GET['success']) && intval($_GET['success']) === -1){?>
    <div class="error">Votre mot de passe doit contenir au moins une lettre en majuscules, en miniscules, etc..</div> <?php
}

//vérif des champs
if(isset($_POST['username']) && isset($_POST['age']) && isset($_POST['password']) && isset($_POST['password-repeat']) && isset($_POST['email'])) {
    //retrait des tags html pas de stockage de page ou de comm en bdd
    //pas d'espace du début à la fin des données
    $username = cleanup($_POST['username']);
    $email = cleanup($_POST['email']);
    $password = cleanup($_POST['password']);
    $passwordRepeat = cleanup($_POST['password-repeat']);
    $age = cleanup($_POST['age']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password !== $passwordRepeat || validatePassword($password)){
        header('Location: index.php?success=0');
    }


    $age = intval($_POST['age']);
    if ($age < 18 || $age > 120){
        $age = 18;
    }


    //données traitées, redirection de l'utilisateur, commenté pour voir les données
    header('Location : ../index.php?success=1');
}
else{
    header('Location : ../index.php?success=0');
}

function cleanup($data, $min=null, $max=null): string {
    $data = trim($data);
    //retrait de toute trace html
    $data = strip_tags($data);

    if ($min !== null && $max !== null){
        $data = intval($data);
        if ($data < 18 || $data > 120){
            $data = 18;
        }
    }

    return $data;
}

function validatePassword($password):bool{
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number= preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    $strlenOK = strlen($password) >= 6 && strlen($password) <= 24;

    if ($uppercase && $lowercase && $number && $specialChars){
        return true;
    }

    return false;
}
?>
