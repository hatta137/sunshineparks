<link rel="stylesheet" href="../assets/css/authentication.css">

<div class="LoginBox">

<form action="index.php?page=registration&logic=addPerson" method="POST">

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
            <label>Telefon</label>
            <input type="text" placeholder="Telefon" name="phone" required>
        </div>

        <div class="InputBox">
            <label>Adresse</label>
            <input type="text" placeholder="Straße" name="street" required>
            <input type="text" placeholder="Hausnummer" name="housenumber" required>
            <input type="text" placeholder="PLZ" name="zipcode" required>
            <input type="text" placeholder="Ort" name="city" required>
            <input type="text" placeholder="Bundesland" name="country">
        </div>


        <div class="InputBox">
            <label>Email Adresse</label>
            <input type="email" placeholder="Email" name="mail" required>

            <label>Passwort</label>
            <input id="pwd1" type="password" placeholder="Passwort" name="pwd" required>
            <input id="pwd2" type="password" placeholder="Passwort wiederholen" name="pwdrepeat" required>
        </div>
    </div>

    <div class="foot">
        <input id="registrate" type="submit" value="Registrieren">
        <input type="hidden" name="mode" value="7">
        <input type="hidden" name="acctype" value="G">
        Bereits ein Konto erstellt?
        <input  type="button" onclick="window.location.href='index.php?page=authentication&view=authenticationGuest'" value="Zur Anmeldung">
    </div>

    <script>

        submitButton = document.querySelector("#registrate");
        function pwdRepeatCheck(){
            if(document.querySelector("#pwd1").value === document.querySelector("#pwd2").value){
                submitButton.disabled = false;
            }else{
                alert("Die Passwörter stimmen nicht überein!");
            }
        }
        //submitButton.disabled = true;
        submitButton.addEventListener("onclick", pwdRepeatCheck);
    </script>
</form>
</div>


