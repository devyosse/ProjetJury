<link rel="stylesheet" href="/Asset/style.css">
<form method="post" action="/index.php?c=user&a=login" id="id-form-connexion">
    <div>
        <input type="text" name="username" id="id-username-connexion" placeholder="Username" required>
    </div>
    <div>

        <input type="password" name="password" id="id-password-connexion" minlength="6" maxlength="24" placeholder="Password" required>
    </div>
    <div>
        <input type="submit" value="Envoyer" name="submit" id="submit-connexion">
    </div>
</form>
