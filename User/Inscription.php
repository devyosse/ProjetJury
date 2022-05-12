<?php
require __DIR__ . '../includes.php';
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
</head>
<body>
<form method="post" action="../GalaxyPhone/GalaxyNew.php">
    <div>
        <label for="id-username">Username</label>
        <input type="text" name="username" id="id-username" required>
    </div>
    <div>
        <label for="id-age">Your age</label>
        <input type="number" name="age" id="id-age" min="18" max="120" required>
    </div>
    <div>
        <label for="id-email">Your Email</label>
        <input type="text" name="email" id="id-email" minlength="18" maxlength="100" required>
    </div>

    <div>
        <label for="id-password">Password</label>
        <input type="password" name="password" id="id-password" minlength="6" maxlength="24" required>
    </div>
    <div>
        <label for="id-password-repeat">Password-repeat</label>
        <input type="password" name="password-repeat" id="id-password-repeat" required>
    </div>
    <div>
        <input type="submit" value="Envoyer" name="submit">
    </div>
</form>

<script src="../Asset/form.js"></script>
</body>
</html>






