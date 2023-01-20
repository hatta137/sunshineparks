<section class="editEmployee">
    <div class="row">
        <h1>Aktuelle Mitarbeiterinformationen:</h1>


        <div class="row">
            <table>
                <tbody>
                <tr><td>Mitarbeiter ID:</td>    <td><?= $updatedEmp->EmpID ?></td></tr>
                <tr><td>Vorname:</td>           <td><?= $updatedPerson->FirstName?></td></tr>
                <tr><td>Nachname:</td>          <td><?= $updatedPerson->LastName?></td></tr>
                <tr><td>Geburtstag:</td>        <td><?= $updatedPerson->DateOfBirth?></td></tr>
                <tr><td>Telefonnummer:</td>     <td><?= $updatedPerson->Tel?></td></tr>
                <tr><td>Mailadresse:</td>       <td><?= $updatedPerson->Mail?></td></tr>
                <tr><td>Vorgesetzter ID:</td>   <td><?= $updatedEmp->Manager?></td></tr>
                <tr><td>Job:</td>               <td><?= $updatedEmp->Job?></td></tr>
                <tr><td>Straße:</td>            <td><?= $updatedAddress->Street?></td></tr>
                <tr><td>Hausnummer:</td>        <td><?= $updatedAddress->HNumber?></td></tr>
                <tr><td>Postleitzahl:</td>      <td><?= $updatedAddress->ZipCode?></td></tr>
                <tr><td>Bundesland:</td>        <td><?= $updatedAddress->State?></td></tr>
                <tr><td>Stadt:</td>             <td><?= $updatedAddress->City?></td></tr>
                <tr><td>Resort:</td>            <td><?= Resort::getResortNameByID($updatedEmp->ResortID);?></td></tr>


                </tbody>
            </table>
        </div>



    </div>
</section>
