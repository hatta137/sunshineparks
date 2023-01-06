<!-- Dieser View wird aufgerufen, sobald ein neues Rental erfolgreich angelegt wurde-->


<section class="newRental">
    <div class="row">
        <h1>Folgendes Objekt wurde erfolgreich angelegt:</h1>
    </div>
    <div class="row">
        <table>
            <tr><td>Straße:</td>        <td><?= $address->street?></td></tr>
            <tr><td>Hausnummer:</td>    <td><?= $address->houseNumber?></td></tr>
            <tr><td>Postleitzahl:</td>  <td><?= $address->zipCode?></td></tr>
            <tr><td>Stadt:</td>         <td><?= $address->city?></td></tr>
            <tr><td>Resort:</td>        <td><?= $newRental->resort?></td></tr>
            <tr><td>Typ:</td>           <td><?= $newRental->type?></td></tr>
            <tr><td>Schlafzimmer:</td>  <td><?= $newRental->bedroom?></td></tr>
            <tr><td>Bäder:</td>         <td><?= $newRental->bathroom?></td></tr>
            <tr><td>Küchen:</td>        <td><?= $special->kitchen?></td></tr>
            <tr><td>Max. Gäste:</td>    <td><?= $newRental->maxVisitor?></td></tr>
            <tr><td>Quadratmeter:</td>  <td><?= $newRental->sqrMeter?></td></tr>
            <tr><td>Zimmernummer:</td>  <td><?= $special->roomnumber?></td></tr>
            <tr><td>Etage:</td>         <td><?= $special->floor?></td></tr>
            <tr><td>Balkon:</td>        <td><?= $special->balcony?></td></tr>
            <tr><td>Terrasse:</td>      <td><?= $special->terrace?></td></tr>

        </table>
    </div>
</section>