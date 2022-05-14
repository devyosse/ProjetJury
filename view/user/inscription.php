
<form method="post" action="/index.php?c=user&a=register">
    <div>
        <label for="id-username">Username</label>
        <input type="text" name="username" id="id-username" required>
    </div>
    <div>
        <label for="id-age">Your age</label>
        <input type="number" name="age" id="id-age" max="120" required>
    </div>
    <div>
        <label for="id-email">Your Email</label>
        <input type="text" name="email" id="id-email" minlength="4" required>
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

<script src="/Asset/form.js"></script>
