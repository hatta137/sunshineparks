<div class="LoginBox">

    <div class="header">
        <h1>Registrierung</h1>
    </div>

    <div class="InputZone">

        <div class="InputBox">
            <label>Name</label>
            <input type="text" placeholder="Vorname" required>
            <input type="text" placeholder="Nachname" required>
        </div>

        <div class="InputBox">
            <label>Adresse</label>
            <input type="text" placeholder="Straße" required>
            <input type="text" placeholder="Hausnummer" required>
            <input type="text" placeholder="PLZ" required>
            <input type="text" placeholder="Ort" required>
        </div>

        <div class="InputBox">
            <label>Telefon</label>
            <input type="tel" placeholder="Telefon" required>
        </div>

        <div class="InputBox">
            <label>Email Adresse</label>
            <input type="email" placeholder="Email" required>

            <label>Passwort</label>
            <input type="password" placeholder="Passwort" required>
            <input type="password" placeholder="Passwort wiederholen" required>
        </div>

    </div>

    <div class="footer">
        <input type="submit" value="Registrieren">
        Bereits ein Konto erstellt?
        <input type="submit" onclick="window.location.href='index.php?page=authentication&view=authenticationGuest'" value="Zur Anmeldung">
    </div>

</div>

</div>
