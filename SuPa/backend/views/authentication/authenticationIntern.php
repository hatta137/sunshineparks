
<link rel="stylesheet" href="../assets/css/authentication.css">

<div class="LoginBox">

    <div>
        <h1>Intern</h1>
    </div>

    <div class="InputZone">
        <form class="InputBox" action="index.php?page=authentication&logic=login" method="POST">
            <label>Email</label>
            <input type="text" placeholder="Email Adresse" name="mail" required>

            <label>Passwort</label>
            <input type="password" placeholder="Passwort" name="pwd" required>

            <input type="submit" value="Login">

            <p>Noch kein Konto?</p>
            <input type="button" onclick="window.location.href='index.php?page=registration&view=registration'" value="Zur Registrierung">
            <input type="button" onclick="window.location.href='index.php?page=authentication&view=authenticationGuest'" value="Gast">
            <input type="hidden" name="authType" value="intern">
        </form>
    </div>
</div>