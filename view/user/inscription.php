
<form method="post" action="/index.php?c=user&a=register" id="id-form" class="form">
    <p class="salutation-inscription">Bien le bonjour, incris-toi afin d'obtenir le maximun de fonctionnalités !</p>

    <div class="class-username">
        <input type="text" name="username" id="id-username" placeholder="Username" required>
    </div>

    <div class="class-age">
        <input type="number" name="age" id="id-age" max="120" placeholder="Your Age" required>
    </div >

    <div class="class-mail">
        <input type="text" name="email" id="id-email" minlength="4" placeholder="Your Email" required>
    </div>

    <div class="class-password">
        <input type="password" name="password" id="id-password" minlength="6" maxlength="24" placeholder="Password" required>
    </div>

    <div class="class-password-repeat">
        <input type="password" name="password-repeat" id="id-password-repeat" placeholder="Password-repeat" required>
    </div>

    <div>
        <input type="submit" value="Envoyer" name="submit" id="submit-inscription">
    </div>
</form>

<script src="/Asset/form.js"></script>
