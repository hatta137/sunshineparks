

<section class="editEmployee">




    <div class="row">
        <h1>Mitarbeiter Nr. <?= $currentEmp->EmpID?> bearbeiten:</h1>
    </div>
    <div class="row">


        <form action="index.php?page=admin&view=updatedEmployee" method="post" id="editEmployeeForm">
            <table id="empTable">
                <tr><td>ID</td><td>         <?= $currentEmp->EmpID?>           </td><td> <input type="hidden"      name="EmpID" value=<?= $currentEmp->EmpID?>>                            </td></tr>
                <tr><td>Vorname</td><td>    <?= $currentPerson->FirstName?>    </td><td> <input type="text"        name="FirstName"    placeholder="Vorname">                              </td></tr>
                <tr><td>Nachname</td><td>   <?= $currentPerson->LastName?>     </td><td> <input type="text"        name="LastName"     placeholder="Nachname">                             </td></tr>
                <tr><td>Geburtsdatum</td><td>   <?= $currentPerson->DateOfBirth?>  </td><td> <input type="date"        name="DateOfBirth"  placeholder="Geburtstag">                           </td></tr>
                <tr><td>Telefon</td><td>        <?= $currentPerson->Tel?>          </td><td> <input type="number"      name="Tel"          placeholder="Telefonnummer">                        </td></tr>
                <tr><td>Email</td><td>          <?= $currentPerson->Mail?>         </td><td> <input type="email"       name="Mail"         placeholder="vorname.nachname@sunshineparks.de">    </td></tr>
                <tr><td>Vorgesetzter</td><td>   <?= $currentEmp->Manager?>         </td><td> <input type="number"      name="Manager"      placeholder="Vorgesetzter">                         </td></tr>
                <tr><td>Job</td><td>            <?= $currentEmp->Job?>             </td><td> <input type="text"        name="Job"       id="Job"   placeholder="Job">                                  </td></tr>
                <tr><td>Straße</td><td>         <?= $currentAddress->Street?>      </td><td> <input type="text"        name="Street"       placeholder="Straße">                               </td></tr>
                <tr><td>Hausnummer</td><td>     <?= $currentAddress->HNumber?>     </td><td> <input type="number"      name="HNumber"      placeholder="Hausnummer">                           </td></tr>
                <tr><td>PLZ</td><td>            <?= $currentAddress->ZipCode?>     </td><td> <input type="text"        name="ZipCode"      placeholder="PLZ">                                  </td></tr>
                <tr><td>Bundesland</td><td>     <?= $currentAddress->State?>       </td><td> <input type="text"        name="State"        placeholder="Bundesland (Kürzel)">                  </td></tr>
                <tr><td>Stadt</td><td>          <?= $currentAddress->City?>        </td><td> <input type="text"        name="City"         placeholder="Stadt">                                </td></tr>
                <tr><td>Passwort</td><td>                                    </td><td> <input type="password"    name="pwd"          placeholder="Passwort">                             </td></tr>
                <tr><td>Resort</td><td> <?= $currentResort?>               </td><td> <select name="Resort">
                            <option value="Usedom"          >Usedom</option>
                            <option value="Erfurt"          >Erfurt</option>
                            <option value="Berchtesgaden"   >Berchtesgaden</option>
                            <option value="Oberhof"         >Oberhof</option>
                        </select> </td></tr>

            </table>
            <input type="submit" value="edit">
            <a href="index.php?page=admin&view=showEmployees"><input type="button" value="zurück"></a>
        </form>

        <div id="errorMassageContainer" </div>
    </div>



</section>