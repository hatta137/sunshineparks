
<link rel="stylesheet" href="../assets/css/authentication.css">

<div class="LoginBox">

    <div class="header">
        <h1>Login</h1>
    </div>

    <div class="InputZone">
        <form class="InputBox" action="index.php?page=authentication&logic=login" method="POST">
            <label>Email</label>
            <input type="email" placeholder="Email Adresse" name="mail" required>

            <label>Passwort</label>
            <input type="password" placeholder="Passwort" name="pwd" required>

            <input type="submit" onclick="window.location.href='index.php?page=account&view=guest'" value="Login">

            <p>Noch kein Konto?</p>
            <input type="submit" onclick="window.location.href='index.php?page=registration&view=registration'" value="Zur Registrierung">
            <input type="submit" onclick="window.location.href='index.php?page=authentication&view=authenticationIntern'" value="Intern">
            <input type="hidden" name="authType" value="guest">
        </form>
    </div>
</div>
