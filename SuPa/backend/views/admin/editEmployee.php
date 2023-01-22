<section class="editEmployee">

        <h1>Mitarbeiter Nr. <?= $currentEmp->EmpID?> bearbeiten:</h1>

    <div class="row">
        <form action="index.php?page=admin&view=updatedEmployee" method="post" id="editEmployeeForm">
            <table id="empTable">
                <tr><th>ID</th><td>             <?= $currentEmp->EmpID?>           </td><td> <label><input type="hidden"      name="EmpID" value=<?= $currentEmp->EmpID?>>                 </label></td></tr>
                <tr><th>Vorname</th><td>        <?= $currentPerson->FirstName?>    </td><td> <label><input type="text"        name="FirstName"    placeholder="Vorname">                     </label></td></tr>
                <tr><th>Nachname</th><td>       <?= $currentPerson->LastName?>     </td><td> <label><input type="text"        name="LastName"     placeholder="Nachname">                     </label></td></tr>
                <tr><th>Geburtsdatum</th><td>   <?= $currentPerson->DateOfBirth?>  </td><td> <label><input type="date"        name="DateOfBirth"  placeholder="Geburtstag">                </label></td></tr>
                <tr><th>Telefon</th><td>        <?= $currentPerson->Tel?>          </td><td> <label><input type="number"      name="Tel"          placeholder="Telefonnummer">                     </label></td></tr>
                <tr><th>Email</th><td>          <?= $currentPerson->Mail?>         </td><td> <label><input type="email"       name="Mail"         placeholder="vorname.nachname@sunshineparks.de"></label></td></tr>
                <tr><th>Vorgesetzter</th><td>   <?= $currentEmp->Manager?>         </td><td> <label><input type="number"      name="Manager"      placeholder="Vorgesetzter">                  </label></td></tr>
                <tr><th>Job</th><td>            <?= $currentEmp->Job?>             </td><td> <label><input id="Job" type="text"        name="Job"        placeholder="Job">                       </label></td></tr>
                <tr><th>Straße</th><td>         <?= $currentAddress->Street?>      </td><td> <label><input type="text"        name="Street"       placeholder="Straße">                         </label></td></tr>
                <tr><th>Hausnummer</th><td>     <?= $currentAddress->HNumber?>     </td><td> <label><input type="number"      name="HNumber"      placeholder="Hausnummer">                    </label></td></tr>
                <tr><th>PLZ</th><td>            <?= $currentAddress->ZipCode?>     </td><td> <label><input type="text"        name="ZipCode"      placeholder="PLZ">                               </label></td></tr>
                <tr><th>Bundesland</th><td>     <?= $currentAddress->State?>       </td><td> <label><input type="text"        name="State"        placeholder="Bundesland (Kürzel)">             </label></td></tr>
                <tr><th>Stadt</th><td>          <?= $currentAddress->City?>        </td><td> <label><input type="text"        name="City"         placeholder="Stadt">                           </label></td></tr>
                <tr><th>Passwort</th><td>                                    </td><td>       <label><input id type="password"    name="pwd"          placeholder="Passwort">                                </label></td></tr>
                <tr><th>Resort</th><td> <?= $currentResort?>               </td><td> <label><select name="Resort">
                            <option value="Usedom"          >Usedom</option>
                            <option value="Erfurt"          >Erfurt</option>
                            <option value="Berchtesgaden"   >Berchtesgaden</option>
                            <option value="Oberhof"         >Oberhof</option>
                        </select></label> </td></tr>

            </table>
            <input type="submit" value="edit">
            <input type="button" onclick="window.location.href='index.php?page=admin&view=showEmployees'" value="zurück">

        </form>
    </div>


        <div id="errorMassageContainer"> </div>

</section>