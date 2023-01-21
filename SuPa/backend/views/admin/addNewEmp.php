<link rel="stylesheet" href="../assets/css/authentication.css">

<div class="LoginBox">

<form action="index.php?page=registration&logic=addPerson" method="POST">

    <div>
        <h1>Neuen Mitarbeiter anlegen</h1>
    </div>

    <div class="InputZone">

        <div class="InputBox">
            <label>Name</label>
            <input type="text" placeholder="Vorname" name="fname" required>
            <input type="text" placeholder="Nachname" name="lname" required>
            <label>Geburtsdatum</label>
            <input type="date" placeholder="Geburtsdatum" name="birthdate" required>

        </div>

        <div class="InputBox">
            <label>Adresse</label>
            <input type="text" placeholder="Straße" name="street" required>
            <input type="text" placeholder="Hausnummer" name="housenumber" required>
            <input type="text" placeholder="PLZ" name="zipcode" required>
            <input type="text" placeholder="Ort" name="city" required>
            <input type="text" placeholder="Bundesland*" name="country">
        </div>

        <div class="InputBox">
            <label>Telefon</label>
            <input type="text" placeholder="Telefon" name="phone" required>
        </div>

        <div class="InputBox">
            <label>Email Adresse</label>
            <input type="email" placeholder="Email" name="mail" required>
            <input type="text" placeholder="Mode 1..7" name="mode" required>
            <input type="text" name="acctype" placeholder="AccountType A/G/E" required>
            <label>Passwort</label>
            <input id="pwd1" type="password" placeholder="Passwort" name="pwd" required>
            <input id="pwd2" type="password" placeholder="Passwort wiederholen" name="pwdrepeat" required>
        </div>
    </div>

    <div class="foot">
        <input id="registrate" type="submit" value="Anlegen!">
        Bereits ein Konto erstellt?
        <input  type="button" onclick="window.location.href='index.php?page=authentication&view=authenticationGuest'" value="Zur Anmeldung">
    </div>

</form>
</div>

