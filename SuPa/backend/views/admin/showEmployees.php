
<section class="showEmployees">




        <div class="row">
            <h1>Mitarbeiter SunshineParks:</h1>
        </div>
        <div class="row">


            <table>
                <tr>
                    <td>Mitarbeiter ID:</td>
                    <td>Vorname:</td>
                    <td>Nachname:</td>
                    <td>Geburtstag:</td>
                    <td>Telefonnummer:</td>
                    <td>E-Mailadresse:</td>

                    <td>Vorgesetzter ID:</td>
                    <td>Job:</td>
                    <td>Straße:</td>
                    <td>Hausnummer:</td>
                    <td>Postleitzahl:</td>
                    <td>Bundesland:</td>
                    <td>Stadt:</td>
                    <td>Resort:</td>
                    <td></td>
                </tr>

                <?php for  ($i = 0; $i < count($allEmployees); $i++):
                $person = $persondata[$i];
                $employee = $allEmployees[$i];
                $address = $allAddresses[$i];
                $resort = $allResorts[$i];

                ?>
                <tr>
                    <td><?= $employee->EmpID?></td>
                    <td><?= $person->FirstName?></td>
                    <td><?= $person->LastName?></td>
                    <td><?= $person->DateOfBirth?></td>
                    <td><?= $person->Tel?></td>
                    <td><?= $person->Mail?></td>

                    <td><?= $employee->Manager?></td>
                    <td><?= $employee->Job?></td>
                    <td><?= $address->Street?></td>
                    <td><?= $address->HNumber?></td>
                    <td><?= $address->ZipCode?></td>
                    <td><?= $address->City?></td>
                    <td><?= $address->State?></td>
                    <td><?= $resort?></td>
                    <td>
                        <form action="index.php?page=admin&view=editEmployee" method="post">
                            <input type="hidden" name="EmpID" value=<?= $employee->EmpID?>>
                            <input type="submit" value="edit">
                        </form>


                    </td>
                </tr>
                <?php endfor; ?>
            </table>
            <a href="index.php?page=account&view=admin"><input type="button" value="zurück"></a>


        </div>



</section>