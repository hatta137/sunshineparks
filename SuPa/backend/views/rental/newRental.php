<section class="newRental">

    <form action="index.php?page=rental&view=addNewRental" method="post">
        <div class="row">
            <h1>Ein neues Objekt anlegen</h1>
        </div>
        <div class="row">
            <div class="newRental-left">


                <h2>Adressinformationen</h2>
                <input type="text" name="street" placeholder="Straße">
                <input type="text" name="houseNumber" placeholder="Hausnummer">
                <input type="text" name="zipCode" placeholder="PLZ">
                <input type="text" name="city" placeholder="Stadt">

            </div>

            <div class="newRental-middle">

                <h2>Objektinformationen</h2>
                <select name="resort">
                    <option value="Usedom">Usedom</option>
                    <option value="Erfurt">Erfurt</option>
                    <option value="Oberhof">Oberhof</option>
                    <option value="Berchtesgaden">Berchtesgaden</option>
                </select>
                <input type="number" name="maxVisitors" placeholder="Maximale Besucherzahl">
                <input type="number" name="bedroom" placeholder="Anzahl Schlafzimmer">
                <input type="number" name="bathroom" placeholder="Anzahl Badezimmer">
                <input type="number" name="sqrMeter" placeholder="Anzahl Quadratmeter">


            </div>
            <div class="newRental-right">

                <h2>Objekt Spezialisierung</h2>
                <select name="type">
                    <option value="Apartment">Apartment</option>
                    <option value="House">House</option>
                </select>



                <fieldset>
                    <input type="radio" id="balcony" name="freeseat" placeholder="Balkon" value="balcony">
                    <label for="balcony">Balkon</label>
                    <input type="radio" id="terrace" name="freeseat" placeholder="Terrasse" value="terrace">
                    <label for="terrace">Terasse</label>
                </fieldset>

                <h3>Bei Apartments</h3>
                <input type="number" name="rnumber" placeholder="Zimmernummer">
                <input type="number" name="floor" placeholder="Etage">

                <h3>Bei Häusern</h3>
                <input type="number" name="kitchen" placeholder="Anzahl Küchen">


            </div>
        </div>
        <div class="row">
            <input type="submit" value="Neues Objekt anlegen" name="send">
        </div>
    </form>
</section>
