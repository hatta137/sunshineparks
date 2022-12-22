<!-- Dieser View wird aufgerufen, sobald ein neues Rental erfolgreich angelegt wurde-->


<section class="newRental">
    <div class="row">
        <h1>Folgendes Objekt wurde erfolgreich angelegt:</h1>
    </div>
    <div class="row">
        <table>
            <tr><td>Straße:</td>        <td><?= $newRental->street?></td></tr>
            <tr><td>Hausnummer:</td>    <td><?= $newRental->houseNumber?></td></tr>
            <tr><td>Postleitzahl:</td>  <td><?= $newRental->zipCode?></td></tr>
            <tr><td>Stadt:</td>         <td><?= $newRental->city?></td></tr>
            <tr><td>Resort:</td>        <td><?= $newRental->resort?></td></tr>
            <tr><td>Typ:</td>           <td><?= $newRental->type?></td></tr>
            <tr><td>Schlafzimmer:</td>  <td><?= $newRental->bedroom?></td></tr>
            <tr><td>Bäder:</td>         <td><?= $newRental->bathroom?></td></tr>
            <tr><td>Küchen:</td>        <td><?= $newRental->kitchen?></td></tr>
            <tr><td>Max. Gäste:</td>    <td><?= $newRental->maxVisitor?></td></tr>
            <tr><td>Quadratmeter:</td>  <td><?= $newRental->sqrMeter?></td></tr>
            <tr><td>Zimmernummer:</td>  <td><?= $newRental->roomnumber?></td></tr>
            <tr><td>Etage:</td>         <td><?= $newRental->floor?></td></tr>
            <tr><td>Balkon:</td>        <td><?= $newRental->balcony?></td></tr>
            <tr><td>Terrasse:</td>       <td><?= $newRental->terrace?></td></tr>

        </table>
    </div>
</section>