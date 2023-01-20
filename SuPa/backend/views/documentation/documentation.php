<section class="topbox">
    <div class="header-content">
        <h1>Dokumentation Projekt: WS202223_GWPDWP_SunshineParks</h1>
        <h2>Buchungswebsite des Ferienresort-Betreibers "Sunshine Parks"</h2>
        <h2>Projektgruppe: "BeOne"</h2>
        <p>Dario Daßler</p>
        <p>Robin Harris</p>
        <p>Hendrik Lendeckel</p>
        <p>Max Schelenz</p>
    </div>
</section>

<!--   About/ Contentlist-->
<section class="contentlist-privacy">
    <div>
        <h2>Entwicklung und Aufbau</h2>
        <ul>
            <li><a class="index-link" href="#desCust">Beschreibung des Kunde</a></li>
            <li><a class="index-link" href="#resProj">Recherche</a></li>
            <li><a class="index-link" href="#sitelay">Seitenlayout</a></li>
            <li><a class="index-link" href="#siteDesign">Design</a></li>
            <li><a class="index-link" href="#siteFunc">Funktionalitäten</a></li>
            <li><a class="index-link" href="#erMod">ER-Modell</a></li>
            <li><a class="index-link" href="#reMod">Relationales Datenbankmodell</a></li>
            <li><a class="index-link" href="#roleMod">Rollenmodell</a></li>
            <li><a class="index-link" href="#dataInput">Flussbild Dateneingabe</a></li>
            <li><a class="index-link" href="#mvcPattern">MVC Pattern</a></li>
        </ul>
        <h2>Reflektion</h2>
        <ul>
            <li><a class="index-link" href="">Herausforderungen und deren Lösung</a></li>
            <li><a class="index-link" href="">Besonderheiten</a></li>
            <li><a class="index-link" href="">Projektmanagement</a></li>
        </ul>
    </div>
</section>


<!--    Beschreibung Kunde -->
<section id="desCust" class="odd">
    <div>
        <h1>Beschreibung des Kunden</h1>
        <h2>Sunshine Parks GmbH</h2>
        <p>
            Unser Kunde “Sunshine Parks GmbH” betreibt vier Ferienresorts in Deutschland. Diese befinden
            sich in Erfurt, Oberhof, Berchtesgaden und auf Usedom. Zur Vermietung stehen Ferienwohnun-
            gen und Häuser für unterschiedlich viele Gäste. Die Feriendörfer verfügen über unterschiedlich
            große Kapazitäten in Bezug auf die Wohnungen und Häuser. Organisatorisch ist die Sunshine
            Parks GmbH aufgeteilt in einen Hauptsitz und den vier Außenstellen, den Resorts.
        </p>
        <br>
        <p>
            <br> Hauptsitz: <br>
            Der Zentrale, mit Sitz in Erfurt, obliegt die Überwachung der Auslastung der Feriendörfer und
            der Finanzen, der Zukunftsplanung und der Bereich der Mitarbeiterverwaltung. Die Chefin ist
            Birgitt Schmidt. Sie ist verantwortlich für die Entwicklung des Unternehmens, die Überwachung
            des Finanzstatus plus Auslastung der Resorts sowie die Außenwirkung der Sunshine Parks. Ihr
            unterstellt sind David Specht, ihr persönlicher Assistent, Christa Arnold ihre HR-Managerin und
            vier Resort Manager*innen. David Specht hat, neben der Entlastung der Chefin, die Aufgabe die
            Buchungsemails an die jeweiligen Resorts weiterzuleiten. Christa Arnold trägt die Verantwortung
            für alle Mitarbeiterangelegenheiten. Sie pflegt die Mitarbeiterlisten, ist über jegliche Abwesen-
            heiten der Mitarbeiter informiert und koordiniert diese. Sie führt die Prozesse Einstellung und
            Entlassung durch und passt die Gehälter der Mitarbeiter an. Die Lohnbuchhaltung und das Rech-
            nungswesen sind ausgelagert an einen Dienstleister und das Steuerbüro.
        </p>
        <p>
            <br> Resort: <br>
            Jede Ferienanlage stellt eine Außenstelle des Unternehmens dar. Diese werden von den Resort-
            managern Rainer Zufall - Berchtesgaden, Heinz Aal - Usedom, Uta Zaun - Oberhof und Sabine
            Meier – Erfurt, geleitet. Sie überwachen die Auslastung, geben Informationen und Auswertung an
            die Vorgesetzten weiter und beauftragen das Marketing. Außerdem sind sie die Vorgesetzten der
            jeweils vier Verwaltungsfachangestellten in den Bereichen Reinigung, Instandhaltung, Buchung
            und Objektverwaltung. Diesen obliegen die folgenden Aufgaben: Verwaltung der Buchungen,
            Einteilung der Reinigungskräfte, Beauftragung der Instandhaltung/Wartung, sowie die Aufrecht-
            erhaltung der Kundenzufriedenheit und Beantwortung der Fragen der Gäste. Jedes Resort verfügt
            über eine unterschiedliche Anzahl an Ferienhäusern und Ferienwohnungen, die von den Gästen
            gemietet werden können. Eine Wohnung besteht aus einem oder mehreren Schlafzimmern (ma-
            ximal 3), einem oder mehreren Bädern (maximal 3), einer Küche, einem oder keinem Balkon und
            kann von bis zu 6 Personen gemietet werden. Die Ferienwohnungen sind in einem oder mehreren
            Häuserkomplexen untergebracht. Die Wohnungen befinden sich auf maximal drei Etagen. Ein
            Haus besitzt mindestens vier Schlafzimmer mit einer Bettenbelegung von max. acht Personen,
            mehrere Küchen (ab 6 Schlafzimmer 2 Küchen), pro Schlafzimmer einem Bad und einer optio-
            nalen Terrasse. Jedes Haus kann von bis zu 16 Personen bezogen werden, die Mindestbelegung
            jedoch beträgt fünf Personen.
        </p>
        <h2>Ziele der Website</h2>
        <p>
            Ziel dieser Website ist es, die vier Resorts der Sunshine Parks GmbH und deren Appartments/Häuser vorzustellen
            und eine Buchungsplattform bereitzustellen. Gäste sollen sich einloggen können und ihre Buchungen einsehen. Falls
            diese noch kein Benutzerkonto haben, soll dieses erstellt werden können. Des Weiteren müssen sich Mitarbeiter
            der Sunshine Parks, je nach Rolle im Unternehmen, anmelden können und bestimmte Informationen abrufen und eingeben
            können. Im Bereich Rollenmodell werden diese Aufgaben aufgeführt.
        </p>
    </div>
</section>

<section id="resProj" class="even">
    <div>
        <h1>Recherche</h1>
        <h2>Ähnliche Websiten</h2>
        <h3>1. airbnb</h3>
        <p><a href="https://www.airbnb.de/" target=”_blank”>Link zur Website airbnb</a></p>
        <p>An der airbnb-Website hat uns das Design der einzelnen Unterkünfte und deren Anordnung (Kacheln) sehr gut gefallen.</p>
        <p>Des weiteren fanden wir das minimalistische Design ansprechend und waren vom responsive-Design überzeugt.</p>
        <img src="graphics/docu/airbnb.png" alt="Airbnb-Website">
        <h3>2. CenterParcs</h3>
        <p><a href="https://www.centerparcs.de/" target=”_blank”>Link zur Website centerparcs</a></p>
        <p>Auf der CenterParcs Website haben wir uns auch einige Inspirationen geholt, welche den Seitenaufbau betreffen.</p>
        <img src="graphics/docu/centerparcs.png" alt="CenterParcs-Website">
    </div>
</section>

<section id="sitelay" class="odd">
    <div>
        <h1>Seitenlayout</h1>

        <h2>Grundlayout</h2>
        <p>
            Hinter dem Layout steht eine Kombination aus Flex-Boxen. Jede Seite ist in drei Bereiche aufgeteilt.
            Header (inkl. Navbar), Main-Section (variiert je nach Seite About, Testimony, Contact, ...) und Footer.
            In der Navbar befinden sich Logo (inkl. Link auf Index-Seite), Firmenname und die eigentlichen Navigationselemente
            in Form einer verlinkenden Liste. Der Footer enthält Navigationselemente zu den Seiten Impressum,
            Kontakt, Datenschutz und den Nutzungsbedingungen.
        </p>
        <h2>Verlinkung/Navigationsstruktur</h2>
        <p>Bild noch einfügen!!!!</p>

    </div>
</section>

<section id="siteDesign" class="even">
    <div>
        <h1>Design</h1>
        <h2>Layout</h2>
        <p>
            Beim Layout haben wir uns dafür entschieden eine moderne Anordnung zu verwenden.
            Beginnend mit einem Header, welcher in der linken oberen Ecke das Firmenlogo, zentriert den Firmennamen sowie rechtsbündig die Navigationselemente enthält.
            Der Content-Bereich wird auf jeder Seite unterschiedlich eingeleitet, schließt jedoch bündig am Header an und unterteilt sich in verschiedene Sektionen.
            Das Ende der Webseite stellt der Footer dar, welcher direkt nach dem Content-Bereich beginnt.
        </p>
        <h2>Farben</h2>
        <p>
            Unsere Hauptfarben sind Hellblau (Keppel #48ac98), sowie die Kontrastfarben Schwarz (Mine Shaft #222222) und Weiß (White #ffffff.
            Im Content-Bereich unterteilen wir unsere inhaltlichen Sections mit heller und dunkler Farbgebung, um eine bessere Lesbarkeit und Gliederung zu erreichen.
        </p>
        <h2>Formen</h2>
        <p>
            Die Buttons sind alle einheitlich designed und die Motive aus einer Bibliothek entnommen, um ein einheitliches Gesamtbild zu gewährleisten.
        </p>
        <h2>Schrift</h2>
        <p>
            Als Schriftart verwenden wir beau.tff - diese hat uns besonders durch ihre geschwungenen Bögen und gute Lesbarkeit überzeugt.
        </p>
        <h2>Positionierung</h2>
        <p>
            Das Firmenlogo ist, wenn möglich und sinnvoll stets links oben auf der Webseite positioniert. Grafiken und Icons sollen sich ins Gesamtbild der Webseite einfügen und
            den Content-Bereich veranschaulichen.
        </p>


    </div>
</section>

<section id="mvcPattern" class ="odd">
    <div>
        <h1>MVC Pattern</h1>
        <img src="../assets/graphics/docu/mvcpattern.png" alt="MVC-Pattern Aufteilung">
        <h2>Aufteilung</h2>
        <p>
            Nach den Übungsstunden zum MVC Pattern haben wir uns gemeinschaftlich dafür entschieden,
            die Aufgaben unter uns zu verteilen.
            Robin kümmert sich um die Views, Dario und Hendrik haben die Controller untereinander aufgeteilt und
            Max befasst sich mit den Models und den Anpassungen der Datenbank.

            Während des Entwicklungsprozesses sind uns kleinere Fehler aufgefallen, bspw. in der Datenbankstruktur oder in den logischen Abläufen.
            In solchen Fällen wurde dann in der Gruppe oder mit dem Verantwortlichen Rücksprache gehalten, wie wir das Problem am besten lösen können
            und im Anschluss wurde sich an das Bugfixing begeben, teilweise zu zweit oder zu dritt oder manchmal auch alleine, wenn der Lösungsweg klar war.

            --Hier noch ein Ausschnitt aus der Ordnerstruktur unseres MVC Patterns ergänzen.
        </p>

        <h2>Architektur</h2>
        <p>
            Hier müssen die Zusammenhänge und wichtigsten Funktionalitäten im MVC erklärt werden.
            @Hendrik oder @Dario, sprecht euch da bitte ab. Ihr 2 habt die beste Übersicht über unsere Abläufe.
        </p>
    </div>
</section>

<section id="siteFunc" class="even">
    <div>
        <h1>Funktionalitäten/Architektur der Seiten</h1>
        <h2>index</h2>
        <p>
            @Hendrik bitte hier dein Part ergänzen
        </p>
        <h2>booking</h2>
        <p>
            @Hendrik
        </p>
        <h2>Anmeldung</h2>
        <p>
            Die Anmeldeformulare sollten möglichst minimalistisch und übersichtlich sein.
            Damit ist dem Nutzer sofort klar wo er was eingeben muss und wie er sich anmelden kann bzw. zur Registrierung kommt, falls er noch kein Benutzerkonto besitzt.
            Zusätzlich gibt es noch eine Schaltfläche, welche vom Login für die Gäste zum Login für den internen Bereich (und umgekehrt) führt.
            Gäste melden sich über "Login" ein. Die anderen Rollen können sich über das Interne Formular anmelden - siehe <a href="#roleMod">Rollenmodell</a>.
            Das Design soll zur restlichen Seite passen und somit wurden die gleichen Schaltflächen und Eingabefelder benutzt.
            Eingabefelder besitzen einen Focus-Effekt welcher die angeklickten Inputs farbig umrandet. Schaltflächen werden mit dem Hover-Effekt Dunkler, wenn man über diese geht.
            Für einen flüssigen Übergang der Effekte wurde eine kurze Transition definiert.
        </p>
        <h2>Registrierung</h2>
        <p>
            Das Registrierungsformular ist analog zum Login aufgebaut. Aufgrund des größeren Umfangs wurde in vier Boxen eingeteilt - Name, Adresse, Telefon, Email/Passwort.
            Jede Box besitzt die jeweiligen Eingabefelder und ist bei verkleinerung der Fensterbreite mit dem flex-wrap Effekt nach unten Stauchbar.
            Somit sind die Boxen im Desktop Vollbild idR. nebeneinander und in der mobilen Ansicht untereinander.
            Unten gibt es die möglichkeit über eine Schaltfläche zum Login zu wechseln.
        </p>
        <h2>allObjects</h2>
        <p>
            @Hendrik
        </p>
        <h2>imprint</h2>
        <p>
            @Hendrik
        </p>
        <h2>privacy</h2>
        <p>
            @Hendrik
        </p>
    </div>
</section>


<section id="erMod" class="odd">
    <div>
        <h1>ER-Modell</h1>
        <img src="../assets/graphics/docu/ERMv12.png" alt="Entity-Relationship-Modell">
        <p>
        Unser ER-Modell ist zur besseren Differenzierung und Zuordnung der Tabellen farblich in die verschiedenen Hauptbereiche unserer Webseite unterteilt.
        Buchungs-,Objektverwaltungs- und Account/Administrationsbereich sind Teile unseres Scope.

        Das abgebildete ER-Modell war zu Beginn deutlich einfacher gehalten, aber während der Projektarbeit ist uns aufgefallen, dass eine genaue Übernahme unseres Datenbankmodell
        aus Modul DB2 nicht möglich ist. Immer wieder kam es zu strukturellen Veränderung in der Datenbank, um die Abläufe realisieren zu können oder
        wir haben die Tabellen optimiert, um die Programmlogik realisieren zu können. Hier wäre der PasswordHash oder der AccountType in PERSON zu nennen.
        In vorherigen Versionen hatten wir den PasswordHash noch in den ChildTabellen EMP, GUEST und ADMIN untergebracht, was wir dann ab ERMv7 verbessert haben.

        PERSONMODE und MODE wurden durch den Registrierungs- und Authentifizierungsbereich benötigt. Dieser lag im zweiten Semester noch außerhalb unseres Scopes und musste nun
        ergänzt werden. Die Erstellung der Rollen- und Rechte Matrix, sowie die paralellen Anpassungen der csv_Imports und des Tabellenmodells sind weitere zu nennende
        Arbeitsschritte in unserem Projekt.
        </p>
    </div>
</section>

<section id="reMod" class="even">
    <div>
        <h1>Relationales Modell</h1>
        <img src="" alt="Tabellenmodell">

    </div>
</section>

<section id="roleMod" class="odd">
    <div>
        <h1>Rollenmodell</h1>
        <img src="../assets/graphics/docu/RollenRechteMatrix.PNG" alt="Rollen- und Rechtematrix">
        <p>
            Die Rollen-Rechte-Matrix zeigt die 8 verschiedenen Modes, die unser Verwaltungssystem benötigt.
            Admin, Cleaning, Maintenance, Manager, Rental, Booking, Guest und Viewer.
            Jeder Erstbesucher unserer Webseite hat automatisch die ModeID 8 und gilt als Viewer.
            Existiert lokal auf dem Gerät des Nutzers ein Cookie mit der SessionID, dann wird aus dem Session_Array die PersonID gelesen und das zugehörige Nutzerkonto eingeloggt mit den jeweiligen zugewiesenen Rechten.
            Meldet sich der Nutzer bei uns im System an, erhält er die Rechte die bei seinem Nutzerkonto hinterlegt sind.
            Die Nutzerrechte werden vor jedem Aufruf nochmals gecheckt und je nachdem ob der Nutzer die Rechte hat oder nicht, wird der Zugriff gewährt oder verweigert.
            Die komplette Rollen-Rechte-Matrix ist unter SuPa/assets/documentation/Files als "Berechtigungen.xlsm" zu finden.
        </p>
    </div>
</section>

<section id="dataInput" class="even">
    <div>
        <h1>Flussbild Dateneingabe</h1>
        <h2>Login und Registrierung</h2>
        <img src="../assets/graphics/docu/Login_Registration.drawio.png" alt="Flussbilddiagramm des Logins und der Registrierung">
        <p>
            Der Besucher der Webseite hat die Möglichkeit im Falle, dass er noch kein Nutzerkonto erstellt hat dieses über das Registrierungsformular vorzunehmen.
            Im Anschluss eine erfolgreiche Registrierung ist der Nutzer dann direkt mit dem Konto angemeldet.
            Sollte bereits ein Konto bestehen wird dies entweder direkt durch einen lokal gespeicherten Cookie erkannt und zugeordnet oder der Nutzer kann sich mit seinen Zugangsdaten im Login anmelden.
            In beiden Fällen erhalten die Nutzer ein Feedback, indem im rechten oberen Bereich der Navbar "Hallo, VornameXY" angezeigt wird.
        </p>

        <h2>Buchungsvorgang und Objektsuche</h2>
        <img src="../assets/graphics/docu/Buchungsvorgang_Objektsuche.drawio.png" alt="Flussbilddiagramm des Buchungsvorgangs und der Objektsuche">

        <h2>Administration und Verwaltung</h2>
        <img src="../assets/graphics/docu/Verwaltung_Administration.drawio.png" alt="Flussbilddiagramm der Administration und Verwaltung">

    </div>
</section>



