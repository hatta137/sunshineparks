<div class="showEmployees">

    <h1>Mitarbeiter SunshineParks:</h1>

    <table id="empTable">
        <tr>
            <th>Mitarbeiter ID:</th>
            <th>Vorname:</th>
            <th>Nachname:</th>
            <th>Geburtstag:</th>
            <th>Telefonnummer:</th>
            <th>E-Mailadresse:</th>
            <th>Vorgesetzter ID:</th>
            <th>Job:</th>
            <th>Straße:</th>
            <th>Hausnummer:</th>
            <th>Postleitzahl:</th>
            <th>Bundesland:</th>
            <th>Stadt:</th>
            <th>Resort:</th>
            <th>Edit</th>
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