<!-- Dieser View wird aufgerufen, sobald ein neues Rental erfolgreich angelegt wurde-->


<section class="newRental">


        <div class="row">
            <h1>Folgendes Objekt wurde erfolgreich angelegt:</h1>
        </div>
        <div class="row">
            <table>
                <tr><td>Straße:</td>        <td><?= $address->Street?></td></tr>
                <tr><td>Hausnummer:</td>    <td><?= $address->HNumber?></td></tr>
                <tr><td>Postleitzahl:</td>  <td><?= $address->ZipCode?></td></tr>
                <tr><td>Stadt:</td>         <td><?= $address->City?></td></tr>
                <tr><td>Resort:</td>        <td><?= $newRental->ResortID?></td></tr>
                <tr><td>Typ:</td>           <td><?= $type?></td></tr>
                <tr><td>Schlafzimmer:</td>  <td><?= $newRental->Bedroom?></td></tr>
                <tr><td>Bäder:</td>         <td><?= $newRental->Bathroom?></td></tr>
                <tr><td>Küchen:</td>        <td><?= $kitchen?></td></tr>
                <tr><td>Max. Gäste:</td>    <td><?= $newRental->MaxVisitor?></td></tr>
                <tr><td>Quadratmeter:</td>  <td><?= $newRental->SqrMeter?></td></tr>
                <tr><td>Zimmernummer:</td>  <td><?= $roomnumber?></td></tr>
                <tr><td>Etage:</td>         <td><?= $floor?></td></tr>
                <tr><td>Balkon:</td>        <td><?= $balcony?></td></tr>
                <tr><td>Terrasse:</td>      <td><?= $terrace?></td></tr>

            </table>
        </div>



</section>