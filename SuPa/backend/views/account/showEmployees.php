
<section class="showEmployees">


        <div class="row">
            <h1>Mitarbeiter SunshineParks:</h1>
        </div>
        <div class="row">
            <?php for  ($i = 0; $i < count($allEmployees); $i++):
            $person = $persondata[$i];
            $employee = $allEmployees[$i];
            $address = $allAddresses[$i];
            $resort = $allResorts[$i];

            ?>

            <table>
                <tr>
                    <td>Mitarbeiter ID:</td>
                    <td>Vorname:</td>
                    <td>Nachname:</td>
                    <td>Geburtstag:</td>
                    <td>Telefonnummer:</td>
                    <td>E-Mailadresse:</td>
                    <td>Account-Typ:</td>
                    <td>Vorgesetzter:</td>
                    <td>Job:</td>
                    <td>Straße:</td>
                    <td>Hausnummer:</td>
                    <td>Postleitzahl:</td>
                    <td>Bundesland:</td>
                    <td>Stadt:</td>
                    <td>Resort:</td>
                </tr>


                <tr>
                    <td><?= $employee->EmpID?></td>
                    <td><?= $person->FirstName?></td>
                    <td><?= $person->LastName?></td>
                    <td><?= $person->Birthdate?></td>
                    <td><?= $person->Tel?></td>
                    <td><?= $person->Mail?></td>
                    <td><?= $person->AccountType?></td>
                    <td><?= $employee->Manager?></td>
                    <td><?= $employee->Job?></td>
                    <td><?= $address->Street?></td>
                    <td><?= $address->Hnumber?></td>
                    <td><?= $address->ZipCode?></td>
                    <td><?= $address->City?></td>
                    <td><?= $address->State?></td>
                    <td><?= $resort?></td>


                </tr>


            </table>


            <?php endfor; ?>
        </div>



</section>