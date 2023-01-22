<section class="newRental">

    <form action="index.php?page=rental&view=addNewRental" method="post" enctype="multipart/form-data">
        <div class="row">
            <h1>Ein neues Objekt anlegen</h1>
        </div>
        <div class="row">
            <div class="newRental-left">


                <h2>Adressinformationen</h2>

                <label><input type="text" name="street" placeholder="Straße"></label>

                <label><input type="text" name="houseNumber" placeholder="Hausnummer"></label>

                <label> <input type="text" name="zipCode" placeholder="PLZ"></label>

                <label> <input type="text" name="city" placeholder="Stadt"></label>

            </div>

            <div class="newRental-middle">

                <h2>Objektinformationen</h2>
                <label>
                    <select name="resort">
                        <option value="Usedom">Usedom</option>
                        <option value="Erfurt">Erfurt</option>
                        <option value="Oberhof">Oberhof</option>
                        <option value="Berchtesgaden">Berchtesgaden</option>
                    </select>
                </label>
                <label><input type="number" name="maxVisitors" placeholder="Maximale Besucherzahl"></label>
                <label><input type="number" name="bedroom" placeholder="Anzahl Schlafzimmer"></label>
                <label><input type="number" name="bathroom" placeholder="Anzahl Badezimmer"></label>
                <label><input type="number" name="sqrMeter" placeholder="Anzahl Quadratmeter"></label>
                <label><input type="file"   name="picture"  id="picture"></label>


            </div>
            <div class="newRental-right">

                <h2>Objekt Spezialisierung</h2>
                <label>
                    <select name="type">
                        <option value="Apartment">Apartment</option>
                        <option value="House">House</option>
                    </select>
                </label>


                <fieldset>
                    <p>Freisitz:</p>
                    <input type="radio" id="balcony" name="freeseat"  value="balcony">
                    <label for="balcony">Balkon</label>
                    <input type="radio" id="terrace" name="freeseat"  value="terrace">
                    <label for="terrace">Terrasse</label>
                    <label for="none"></label><input type="radio" id="none" name="freeseat" value="none">
                    <label for="terrace">Kein</label>
                </fieldset>

                <h3>Bei Apartments</h3>
                <label><input type="number" name="rnumber" placeholder="Zimmernummer"></label>
                <label><input type="number" name="floor" placeholder="Etage"></label>

                <h3>Bei Häusern</h3>
                <label><input type="number" name="kitchen" placeholder="Anzahl Küchen"></label>




            </div>
        </div>
        <div class="row">
            <input type="submit" value="Neues Objekt anlegen" name="send">
        </div>
    </form>
</section>
