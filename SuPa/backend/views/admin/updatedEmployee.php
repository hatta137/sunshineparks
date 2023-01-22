<section class="showEmployees">

        <h1>Aktuelle Mitarbeiterinformationen:</h1>


    <div class="row">

        <div>
            <table id="empTable">
                <tbody>
                <tr><th>Mitarbeiter ID:</th>    <td><?= $updatedEmp->EmpID ?></td></tr>
                <tr><th>Vorname:</th>           <td><?= $updatedPerson->FirstName?></td></tr>
                <tr><th>Nachname:</th>          <td><?= $updatedPerson->LastName?></td></tr>
                <tr><th>Geburtstag:</th>        <td><?= $updatedPerson->DateOfBirth?></td></tr>
                <tr><th>Telefonnummer:</th>     <td><?= $updatedPerson->Tel?></td></tr>
                <tr><th>Mailadresse:</th>       <td><?= $updatedPerson->Mail?></td></tr>
                <tr><th>Vorgesetzter ID:</th>   <td><?= $updatedEmp->Manager?></td></tr>
                <tr><th>Job:</th>               <td><?= $updatedEmp->Job?></td></tr>
                <tr><th>Straße:</th>            <td><?= $updatedAddress->Street?></td></tr>
                <tr><th>Hausnummer:</th>        <td><?= $updatedAddress->HNumber?></td></tr>
                <tr><th>Postleitzahl:</th>      <td><?= $updatedAddress->ZipCode?></td></tr>
                <tr><th>Bundesland:</th>        <td><?= $updatedAddress->State?></td></tr>
                <tr><th>Stadt:</th>             <td><?= $updatedAddress->City?></td></tr>
                <tr><th>Resort:</th>            <td><?= Resort::getResortNameByID($updatedEmp->ResortID);?></td></tr>
                </tbody>
            </table>

            <input type="button" onclick="window.location.href='index.php?page=account&view=admin'" value="zurück">
        </div>

    </div>

</section>
