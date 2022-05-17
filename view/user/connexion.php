<form method="post" action="/index.php?c=user&a=login" id="class-form-connexion">

    <p class="salutation">Te voilà de retour, connecte-toi !</p>
    <div>
        <input type="email" name="mail" class="class-email-connexion" placeholder="Adresse mail" required>
    </div>
    <div>
        <input type="password" name="password" class="class-password-connexion" minlength="6" maxlength="24" placeholder="Mot de passe" required>
    </div>
    <div>
        <input type="submit" value="Envoyer" name="send-form" id="submit-connexion">
    </div>
</form>
