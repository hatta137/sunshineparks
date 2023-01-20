<div class="editEmployee">

        <h1>Mitarbeiter Nr. <?= $currentEmp->EmpID?> bearbeiten:</h1>

        <form action="index.php?page=admin&view=updatedEmployee" method="post" id="editEmployeeForm">
            <table id="empTable">
                <tr><th>ID</th><td>             <?= $currentEmp->EmpID?>           </td><td> <input type="hidden"      name="EmpID" value=<?= $currentEmp->EmpID?>>                            </td></tr>
                <tr><th>Vorname</th><td>        <?= $currentPerson->FirstName?>    </td><td> <input type="text"        name="FirstName"    placeholder="Vorname">                              </td></tr>
                <tr><th>Nachname</th><td>       <?= $currentPerson->LastName?>     </td><td> <input type="text"        name="LastName"     placeholder="Nachname">                             </td></tr>
                <tr><th>Geburtsdatum</th><td>   <?= $currentPerson->DateOfBirth?>  </td><td> <input type="date"        name="DateOfBirth"  placeholder="Geburtstag">                           </td></tr>
                <tr><th>Telefon</th><td>        <?= $currentPerson->Tel?>          </td><td> <input type="number"      name="Tel"          placeholder="Telefonnummer">                        </td></tr>
                <tr><th>Email</th><td>          <?= $currentPerson->Mail?>         </td><td> <input type="email"       name="Mail"         placeholder="vorname.nachname@sunshineparks.de">    </td></tr>
                <tr><th>Vorgesetzter</th><td>   <?= $currentEmp->Manager?>         </td><td> <input type="number"      name="Manager"      placeholder="Vorgesetzter">                         </td></tr>
                <tr><th>Job</th><td>            <?= $currentEmp->Job?>             </td><td> <input type="text"        name="Job"       id="Job"   placeholder="Job">                                  </td></tr>
                <tr><th>Straße</th><td>         <?= $currentAddress->Street?>      </td><td> <input type="text"        name="Street"       placeholder="Straße">                               </td></tr>
                <tr><th>Hausnummer</th><td>     <?= $currentAddress->HNumber?>     </td><td> <input type="number"      name="HNumber"      placeholder="Hausnummer">                           </td></tr>
                <tr><th>PLZ</th><td>            <?= $currentAddress->ZipCode?>     </td><td> <input type="text"        name="ZipCode"      placeholder="PLZ">                                  </td></tr>
                <tr><th>Bundesland</th><td>     <?= $currentAddress->State?>       </td><td> <input type="text"        name="State"        placeholder="Bundesland (Kürzel)">                  </td></tr>
                <tr><th>Stadt</th><td>          <?= $currentAddress->City?>        </td><td> <input type="text"        name="City"         placeholder="Stadt">                                </td></tr>
                <tr><th>Passwort</th><td>                                    </td><td> <input type="password"    name="pwd"          placeholder="Passwort">                             </td></tr>
                <tr><th>Resort</th><td> <?= $currentResort?>               </td><td> <select name="Resort">
                            <option value="Usedom"          >Usedom</option>
                            <option value="Erfurt"          >Erfurt</option>
                            <option value="Berchtesgaden"   >Berchtesgaden</option>
                            <option value="Oberhof"         >Oberhof</option>
                        </select> </td></tr>

            </table>
            <input type="submit" value="edit">
            <a href="index.php?page=admin&view=showEmployees"><input type="button" value="zurück"></a>
        </form>

        <div id="errorMassageContainer"> </div>

</div>