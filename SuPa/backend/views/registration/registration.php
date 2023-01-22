<link rel="stylesheet" href="../assets/css/authentication.css">

<div class="LoginBox">

<form action="index.php?page=registration&logic=addPerson" method="POST">

    <div>
        <h1>Registrierung</h1>
    </div>

    <div class="InputZone">

        <div class="InputBox">
            <label>Name</label>
            <label><input type="text" placeholder="Vorname" name="fname" required></label>
            <label><input type="text" placeholder="Nachname" name="lname" required></label>
            <label>Geburtsdatum</label>
            <label><input type="date" name="birthdate" required></label>
            <label>Telefon</label>
            <label><input type="text" placeholder="Telefon" name="phone" required></label>
        </div>

        <div class="InputBox">
            <label>Adresse</label>
            <label><input type="text" placeholder="Straße" name="street" required></label>
            <label><input type="text" placeholder="Hausnummer" name="housenumber" required></label>
            <label><input type="text" placeholder="PLZ" name="zipcode" required></label>
            <label><input type="text" placeholder="Ort" name="city" required></label>
            <label><input type="text" placeholder="Bundesland" name="country"></label>
        </div>


        <div class="InputBox">
            <label><label>Email Adresse</label></label>
            <label><input type="email" placeholder="Email" name="mail" required></label>

            <label>Passwort</label>
            <label><input id="pwd1" type="password" placeholder="Passwort" name="pwd" required></label>
            <label><input id="pwd2" type="password" placeholder="Passwort wiederholen" name="pwdrepeat" required></label>
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


