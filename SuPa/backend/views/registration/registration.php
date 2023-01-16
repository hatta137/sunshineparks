<link rel="stylesheet" href="../assets/css/authentication.css">

<div class="LoginBox">
<form action="index.php?page=registration&logic=registration" method="POST">

    <div>
        <h1>Registrierung</h1>
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

            <label>Passwort</label>
            <input type="password" placeholder="Passwort" name="pwd" required>
            <input type="password" placeholder="Passwort wiederholen" name="pwdrepeat" required>
        </div>
    </div>

    <div class="foot">
        <div>
            <input type="submit" value="Registrieren">
            <label>Bereits ein Konto erstellt?</label>
            <input type="submit" onclick="window.location.href='index.php?page=authentication&view=authenticationGuest'" value="Zur Anmeldung">
        </div>
    </div>


</form>
</div>


