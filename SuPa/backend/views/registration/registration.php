<link rel="stylesheet" href="../assets/css/authentication.css">

<div class="LoginBox">

    <div class="header">
        <h1>Registrierung</h1>
    </div>

    <div class="InputZone">

        <form class="InputBox" action="index.php?page=registration&logic=registration" method="POST">
            <label>Name</label>
            <input type="text" placeholder="Vorname" name="fname" required>
            <input type="text" placeholder="Nachname" name="lname" required>
        </form>

        <form class="InputBox" action="index.php?page=registration&logic=registration" method="POST">
            <label>Adresse</label>
            <input type="text" placeholder="Straße" name="street" required>
            <input type="text" placeholder="Hausnummer" name="housenumber" required>
            <input type="text" placeholder="PLZ" name="zipcode" required>
            <input type="text" placeholder="Ort" name="city" required>
            <input type="text" placeholder="Bundesland*" name="country">
        </form>

        <form class="InputBox" action="index.php?page=registration&logic=registration" method="POST">
            <label>Telefon</label>
            <input type="text" placeholder="Telefon" name="phone" required>
        </form>

        <form class="InputBox" action="index.php?page=registration&logic=registration" method="POST">
            <label>Email Adresse</label>
            <input type="email" placeholder="Email" name="mail" required>

            <label>Passwort</label>
            <input type="password" placeholder="Passwort" name="pwd" required>
            <input type="password" placeholder="Passwort wiederholen" name="pwdrepeat" required>
        </form>
    </div>

    <div class="foot">
        <form>
        <input type="submit" value="Registrieren">
        Bereits ein Konto erstellt?
        <input type="button" onclick="window.location.href='index.php?page=authentication&view=authenticationGuest'" value="Zur Anmeldung">
        </form>
    </div>

</div>

</div>
