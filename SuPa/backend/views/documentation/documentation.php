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
            <li><a class="index-link" href="#herausforderungen">Herausforderungen und deren Lösung</a></li>
            <li><a class="index-link" href="#besonderheiten">Besonderheiten</a></li>
            <li><a class="index-link" href="#projektmanagement">Projektmanagement</a></li>
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
        <img src="../assets/documentation/Pictures/airbnb.png" alt="Airbnb-Website" width="75%">
        <h3>2. CenterParcs</h3>
        <p><a href="https://www.centerparcs.de/" target=”_blank”>Link zur Website centerparcs</a></p>
        <p>Auf der CenterParcs Website haben wir uns auch einige Inspirationen geholt, welche den Seitenaufbau betreffen.</p>
        <img src="../assets/documentation/Pictures/centerparcs.png" alt="CenterParcs-Website" width="75%">
    </div>
</section>

<section id="sitelay" class="odd">
    <div>
        <h1>Seitenlayout</h1>

        <h2>Grundlayout</h2>


        <h3>Header</h3>

        <img src="../assets/documentation/Layout/Header.PNG" alt="Header der Webseite">


        <h3>Main-Section</h3>

        <ul id="main-section-gallery">
            <li><button tabindex="1"><img src="../assets/documentation/Layout/Filterbox.png" alt="Filterbox in der Main-Section"></button></li>
            <li><button tabindex="1"><img src="../assets/documentation/Layout/Content-Boxen-main.png" alt="Informationen über SunshineParks"></button></li>
            <li><button tabindex="1"><img src="../assets/documentation/Layout/Buchungsablauf_Bewertungen.png" alt="Informationen zum Buchungsablauf und Kundenbewertungen"></button></li>
            <li><button tabindex="1"><img src="../assets/documentation/Layout/Kontaktbox.png" alt="Formular zur Kontaktaufnahme"></button></li>
            <li><button tabindex="1"><img src="../assets/documentation/Layout/Footer.png" alt="Footer der Webseite"></button></li>
        </ul>


        <h3>Footer</h3>

        <img src="../assets/documentation/Layout/Header.PNG" alt="Header der Webseite">


        <h4>Beschreibung</h4>
        <p>
            Hinter dem Layout steht eine Kombination aus Flex-Boxen. Jede Seite ist in drei Bereiche aufgeteilt.
            Header (inkl. Navbar), Main-Section (variiert je nach Seite About, Testimony, Contact, Administration ...) und Footer.
            In der Navbar befinden sich Logo (enthält Link auf Index-Seite), Firmenname und die eigentlichen Navigationselemente
            in Form einer verlinkenden Liste.
            Der Footer enthält Navigationselemente zu den Seiten Impressum, Kontakt, Datenschutz und den Nutzungsbedingungen.
        </p>

        <h2>Verlinkung/Navigationsstruktur</h2>
        <p>
            Beim Aufruf unserer Webseite gelangt man zunächst auf die index.php
            Dort hat der Nutzer nun die Möglichkeit in der Navbar die Navigationselemente wie bspw. Account zu nutzen, um in den Accountbereich mit Login und Registrierung zu gelangen,
            um sein Nutzerkonto anzulegen oder zu verwalten.
        </p>
        <img src="../assets/documentation/Layout/NavigationselementeHeader.png" alt="Navigationselemente Help, About und Account im Header">
        <p>
            Ist der Nutzer angemeldet werden ihm im Accountbereich je nachdem welche Rolle und Rechte seinem Account zugewiesen sind verschiedene Funktionalitäten und Unterseiten angezeigt
            auf welche er Zugriff erhält und sich durch Betätigen der jeweiligen Buttons dahin navigieren kann.
        </p>

        <p>
            Durch das Anklicken des Logos oder der Überschrift im Header wird der Nutzer egal, auf welcher Seite er sich aktuell befindet direkt zur index.php geleitet.
            Das soll unseren Nutzern ermöglichen schnellstmöglich zur Hauptseite unserer Webseite zu gelangen.

            Unsere Hauptseite enthält zu Beginn eine Filterbox, in welcher der Nutzer die Möglichkeit hat Filterkriterien einzugeben oder sich direkt alle Rentals anzeigen zu lassen.
            Mittels dieser Suchkriterien gelangt der Nutzer in den Buchungsbereich. Wo er sich dafür entscheiden kann ein Objekt was ihm gefällt zu Buchen oder sich mehr Informationen zum Rental anzeigen zu lassen.
            (Diese Bereiche des Buchungsvorgangs decken wir mit unserer Websiete jedoch nicht ab).
        </p>

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
        <img src="../assets/documentation/Style/Colours/colours.png" alt="Primär-und Sekundärfarben der SunshineParks Webseite">
        <p>
            Die Primärfarben unserer Webseite sind Keppel #48ac98 und Mine Shaft #222222.
            Keppel wird vor allem für Buttons und farbliche Hervorhebungen genutzt.
            Mine Shaft wird für Footer, Header und Hintergründe verwendet, aber auch für Text, da wir Farbinvertierung zur Sectionaufteilung verwenden.
            Als Sekundärfarbe verwenden wir White #ffffff für Text und Hintergründe.
        </p>
        <h2>Formen</h2>
        <img src="../assets/documentation/Style/Icons/icons.png" alt="Beispiel für verwendete Icons im Content-Bereich">
        <p>
            Die verwendeten Formen stammen alle aus einer Designerbibliothek von Bocicons.com, um einheitliche Motive verwenden zu können. Das Logo, sowie die verwendeten Icons
            folgen alle demselben Stil, um ein stimmiges Gesamtbid zu erzeugen.
        </p>
        <h2>Schrift</h2>
        <img src="../assets/documentation/Style/Fonts/font.png" alt="beau.tff Fontbeispiel">
        <p>
            Als Schriftart verwenden wir beau.tff - diese hat uns besonders durch ihre geschwungenen Bögen und gute Lesbarkeit überzeugt.
        </p>
        <h2>Positionierung</h2>
        <img src="../assets/documentation/Layout/positionierung.png" alt="Logopositionierung und Gesamteindruck der Webseite">
        <p>
            Das Firmenlogo ist, wenn möglich und sinnvoll stets links oben auf der Webseite positioniert. Grafiken und Icons sollen sich ins Gesamtbild der Webseite einfügen und
            den Content-Bereich veranschaulichen.
        </p>


    </div>
</section>



<section id="siteFunc" class="odd">
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
            Die Anmeldeformulare sollen eine minimalistische und übersichtliche Gestaltung aufweisen, um Nutzern eine intuitive Navigation zu ermöglichen.
            Es gibt eine Schaltfläche, die zwischen dem Login für Gäste und dem Login für den internen Bereich wechselt. Gäste melden sich über die
            "Login"-Schaltfläche an, während andere Rollen sich über ein internes Formular anmelden (siehe <a href="#roleMod">Rollenmodell</a>). Das Design der Formulare soll
            an das Design der restlichen Seite angepasst sein, indem die gleichen Schaltflächen und Eingabefelder verwendet werden. Eingabefelder besitzen
            einen Focus-Effekt, der angeklickte Inputs farblich umrandet und Schaltflächen werden beim Überfahren dunkler dargestellt. Für einen flüssigen
            Übergang der Effekte ist eine kurze Transition definiert.

<!--         Die Anmeldeformulare sollten möglichst minimalistisch und übersichtlich sein.-->
<!--         Damit ist dem Nutzer sofort klar wo er was eingeben muss und wie er sich anmelden kann bzw. zur Registrierung kommt, falls er noch kein Benutzerkonto besitzt. -->
<!--         Zusätzlich gibt es einen Button, welcher vom Login für die Gäste zum Login für den internen Bereich (und umgekehrt) führt. -->
<!--         Gäste melden sich über "Login" ein. Alle anderen Rollen (außer Viewer) können sich über das Interne Formular anmelden - siehe <a href="#roleMod">Rollenmodell</a>.-->
<!--         Das Design soll zur restlichen Seite passen und somit wurden die gleichen Schaltflächen und Eingabefelder benutzt.-->
<!--         Eingabefelder besitzen einen Focus-Effekt welcher die angeklickten Inputs farbig umrandet. Schaltflächen werden mit dem Hover-Effekt Dunkler, wenn man über diese geht.-->
<!--         Für einen flüssigen Übergang der Effekte wurde eine kurze Transition definiert. -->

        </p>
        <h2>Registrierung</h2>
        <p>
            Das Registrierungsformular ist analog zum Login aufgebaut. Aufgrund des größeren Umfangs wurde in vier Boxen eingeteilt - Name, Adresse, Telefon, Email/Passwort.
            Jede Box besitzt die jeweiligen Eingabefelder und ist bei verkleinerung der Fensterbreite mit dem flex-wrap Effekt nach unten Stauchbar.
            Somit sind die Boxen im Desktop Vollbild idR. nebeneinander und in der mobilen Ansicht untereinander.
            Unten gibt es die möglichkeit über eine Schaltfläche zum Login zu wechseln.

  <!--          Das Registrierungsformular ist analog zum Login aufgebaut. Die Eingabefälder sind nach Kategorie in Containern (InputBox) sortiert          -->
  <!--          Durch die flex-wrap Eigenschaften sind die Container im Desktop Vollbild nebeneinander und in der mobilen Ansicht untereinander angereiht.  -->
  <!--          Unterhalb gibt es die Möglichkeit über eine Schaltfläche zum Login zu wechseln.                                                             -->
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


<section id="erMod" class="even">
    <div>
        <h1>ER-Modell</h1>
        <img src="../assets/documentation/DB_Diagrams/ERMv12.png" alt="Entity-Relationship-Modell">
        <p>
        Unser ER-Modell ist zur besseren Differenzierung und Zuordnung der Tabellen farblich in die verschiedenen Hauptbereiche unserer Webseite unterteilt.
        Buchungs-,Objektverwaltungs- und Account/Administrationsbereich sind die Bestandteile unseres Scopes.

        Das abgebildete ER-Modell war zu Beginn deutlich einfacher gehalten, aber während der Projektarbeit ist uns aufgefallen, dass eine genaue Übernahme unseres Datenbankmodell
        aus Modul DB2 nicht möglich ist. Immer wieder kam es zu strukturellen Veränderung in der Datenbank, um die Abläufe realisieren zu können oder
        wir haben die Tabellen optimiert, um die Programmlogik realisieren zu können. Hier wäre der PasswordHash oder der AccountType in PERSON zu nennen.
        In vorherigen Versionen hatten wir den PasswordHash noch in den ChildTabellen EMP, GUEST und ADMIN untergebracht, was wir dann im weiteren Versionsverlauf verbessert haben.

        PERSONMODE und MODE wurden durch den Registrierungs- und Authentifizierungsbereich benötigt. Dieser lag im zweiten Semester noch außerhalb unseres Scopes und musste nun
        ergänzt werden. Die Erstellung der Rollen- und Rechte Matrix, sowie die paralellen Anpassungen der csv_Imports und des Tabellenmodells sind weitere immer wiederkehrende Entwicklungsschritte
        Arbeitsschritte in unserem Projekt.
        </p>
    </div>
</section>

<section id="reMod" class="odd">
    <div>
        <h1>Relationales Modell</h1>
        <img src="relationales Modell ergänzen" alt="Tabellenmodell">

    </div>
</section>

<section id="roleMod" class="odd">
    <div>
        <h1>Rollenmodell</h1>
        <img src="../assets/documentation/DB_Diagrams/RollenRechteMatrix.PNG" alt="Rollen- und Rechtematrix">
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
        <img src="../assets/documentation/FlowCharts/Login_Registration.drawio.png" alt="Flussbilddiagramm des Logins und der Registrierung">
        <p>
            Der Besucher der Webseite hat die Möglichkeit im Falle, dass er noch kein Nutzerkonto erstellt hat dieses über das Registrierungsformular vorzunehmen.
            Im Anschluss eine erfolgreiche Registrierung ist der Nutzer dann direkt mit dem Konto angemeldet.
            Sollte bereits ein Konto bestehen wird dies entweder direkt durch einen lokal gespeicherten Cookie erkannt und zugeordnet oder der Nutzer kann sich mit seinen Zugangsdaten im Login anmelden.
            In beiden Fällen erhalten die Nutzer ein Feedback, indem im rechten oberen Bereich der Navbar "Hallo, VornameXY" angezeigt wird.
        </p>

        <h2>Buchungsvorgang und Objektsuche</h2>
        <img src="../assets/documentation/FlowCharts/Buchungsvorgang_Objektsuche.drawio.png" alt="Flussbilddiagramm des Buchungsvorgangs und der Objektsuche">
        <p>
            Ein Besucher der SunshineParks Webseite kann sich mit Hilfe der Filterbox auf der home.php einen Überblick über die Objekte unserer Ferienresorts verschaffen.
            Hierzu hat er die Möglichkeit die vorgegebenen Suchkriterien zu nutzen oder sich alle buchbaren Objekte anzeigen zu lassen.
            Daraufhin folgt eine Auflistung der gefilterten Rentals, die dann gebucht werden oder bei Interesse weitere Informationen angezeigt werden können.
            Diesen "Kaufvorgang" decken wir in unserem Projekt jedoch nicht weiter ab.
        </p>
        <h2>Administration und Verwaltung</h2>
        <img src="../assets/documentation/FlowCharts/Verwaltung_Administration.drawio.png" alt="Flussbilddiagramm der Administration und Verwaltung">
        <p>
            -Hier noch Verwaltungstext ergänzen-
        </p>
    </div>
</section>


<section id="mvcPattern" class ="odd">
    <div>
        <h1>MVC Pattern</h1>
        <h2>Allgemein</h2>
        <img src="../assets/documentation/MVC/mvcpattern.png" alt="MVC-Pattern Aufteilung">


        <h1>Architektur</h1>

        <p>
            Bei diesem Projekt wurde das MVC Pattern verwendet, um die Navigation und die Anzeige von Inhalten zu steuern.
            Der Controller-Name (page), Action-Name (view) und Logic-Name (logic) werden aus der URL mithilfe der $_GET[ ]-Variable gelesen.
            Diese drei Parameter bestimmen welche View mit welchen Informationen gerendert wird. Wenn diese Werte nicht zugeordnet
            werden können, wird eine Fehlerseite aufgerufen. Wenn kein Wert angegeben wird, wird der Benutzer immer zur
            Startseite (home.php) weitergeleitet. Zusätzlich wird vor dem Aufruf einer Seite ein Permission-Check durchgeführt,
            um sicherzustellen, dass der Benutzer das Recht hat, diese Seite anzuzeigen. Dies ist besonders wichtig, da es einen
            internen Bereich gibt, der nur von Mitarbeitern und Administratoren besucht werden darf.
        </p>
        </br>
        <p>
            Die meiste Logik wird in den Controllern verarbeitet. Die Models dienen als Abbilder der Datenbanktabellen und übernehmen die
            Lese- und Schreibzugriffe auf diese. Sie stellen zudem Funktionen bereit, die von den Controllern genutzt werden, um einfachen
            Zugriff auf die Daten zu ermöglichen. Die Controller übergeben den Views die Informationen als Array von Parametern.
            In den Views wird die Darstellung dargestellt und die Informationen werden aus den Array-Parametern mithilfe von
            PHP-For-Schleifen iteriert.
        </p>
        </br>
        <p>
            In den Grafiken ist dargestellt, welche Views, Controller und Models zusammenwirken und welche Datenbanken zum
            Lesen und Schreiben von Informationen verwendet werden. Im Projekt wurde darauf geachtet, dass alle Datenbankzugriffe
            dem CRUD-Prinzip (Create, Read, Update, Delete) entsprechen. Das Erstellen von Daten wurde mit dem Bereich der
            Registrierung abgedeckt, das Lesen von Daten nimmt den größten Teil ein und ist in jedem Model implementiert.
            Das Updaten von Daten wurde mit der Funktion editEmployee umgesetzt und Gäste können ihren Account mit der Löschfunktion löschen.
        </p>

        <h2>Rental</h2>
        <p>Nachfolgend sind die Zusammenhänge im Bereich Rental dargestellt:</p>
        <img src="../assets/documentation/MVC/mvc-rental.png" alt="MVC-Rental">

        <h2>Admin</h2>
        <p>Nachfolgend sind die Zusammenhänge im Bereich Administration dargestellt:</p>
        <img src="../assets/documentation/MVC/mvc-rental.png" alt="MVC-Admin">

        <h2>Authentication</h2>
        <p>@Dario Bild einfügen</p>

        <h2>Account</h2>
        <p>@Dario Bild einfügen</p>

        <h2>Registration</h2>
        <p>@Dario Bild einfügen</p>

        <h2>Documentation</h2>
        <p>
            Der View documentation.php wird über den Controller documentation.php aufgerufen.
        </p>

        <h2>Error</h2>
        <p>@Dario Bild einfügen</p>

        <h2>Home</h2>
        <p>
            Der View home.php wird über den Controller home.php aufgerufen. Über den "ZEIG ALLE" und "SUCHE" Button wird der Controller
            rental.php aufgerufen, welcher mit den übergebenen Informationen das Anzeigen der Rentals übernimmt.
        </p>

        <h2>Imprint</h2>
        <p>
            Der View imprint.php wird über den Controller imprint.php aufgerufen.
        </p>

        <h2>Privacy</h2>
        <p>
            Der View privacy.php wird über den Controller privacy.php aufgerufen.
        </p>

    </div>
</section>



<section id="herausforderungen" class="even">
    <div>
        <h1>Herausforderungen und deren Lösung</h1>

        <h2>MVC-Pattern</h2>
        <p>
            Die größte Herausforderung bei diesem Projekt war die Implementierung des MVC Patterns. Unser Projekt war vorher statisch
            und nur nach html-Seiten unterteilt. Aufgrund unseres Mangels an Erfahrung mit solchen Programmier-Patterns musste unsere
            Gruppe die Umsetzung von Anfang an erlernen, was zu Verzögerungen in unserer Zeitplanung führte. Durch mehrere Programmier-Sprints
            und viel Selbststudium konnten wir das MVC-Pattern schlussendlich implementieren und gleichzeitig die Funktionen der Seiten
            programmieren. Dieses Pattern hat uns schlussendlich dabei geholfen, die Arbeit unter den Gruppenmitgliedern zu verteilen
            und komplexe Probleme durch deren Zerteilung zu lösen.
        </p>

        <h2>CSS</h2>
        <p>
            Zu Beginn des Projektes wurden von allen Gruppenmitgliedern mehrere Entwürfe der Seiten gezeichnet und teilweise wurden diese
            Mockups auch programmiert. Das finale Design wurde aus diesen Stücken zusammengestellt. Es wurde sich auch an anderen Websites
            und Tutorials orientiert. So entstanden pro Mitglied unterschiedliche herangehensweisen an das Adressieren der HTML Sectionen und
            deren Elemente. Das hatte zur Folge, dass der CSS-Code immer wieder unvorhergesehene Dinge bewirkte. Erst mit der Neuaufteilung
            der Gruppe (durch MVC) hat sich ausschließlich Robin Harris um das Frontend Design und die optische Anpassung der Views gekümmert.
            Mit dieser Zuteilung und einigen Änderungen am CSS-Code konnte ein optisch überzeugendes Auftreten umgesetzt werden.
            Dennoch ist sich unserer Gruppe einig, bei einem nächsten Web-Projekt anders an den Frontend-Part heranzugehen. Eine einheitliche
            Adressierung und das Arbeiten nach dieser Vorgabe sollte in Zukunft viel Trouble-Shooting ersparen.
        </p>
    </div>
</section>


<section id="besonderheiten" class="odd">
    <div>
        <h1>Besonderheiten</h1>
    </div>
</section>

<section id="projektmanagement" class="even">
    <div>
        <h1>Projektmanagement</h1>

<!--        Tabelle mit Tätigkeit / zuständiger Person / benötigtem Aufwand-->

        <p>
            In der folgenden Tabelle sind die Tätigkeiten der einzelnen Gruppenmitglieder und deren Zeitaufwand aufgelistet.
            Ein großteil der gelisteten Elemente verliefen Parallel. Deshalb konnte der zeitliche Aufwand nur grob aufgenommen werden.
            Auch die Grenzen der Zuständigkeit verschwimmt, da sich alle Gruppenmitglieder gegenseitig unterstützten.
        </p>

        <table id="docTable">
            <thead>
                <tr><th>Tätigkeit</th>  <th>Zuständige Person</th>  <th>Benötigter Aufwand</th></tr>
            </thead>
            <tbody>
                <tr><td>Ideen-Sammlung</td> <td>komplette Gruppe</td> <td>1 Woche</td></tr>
                <tr><td>Grobes Design der Seiten</td> <td>komplette Gruppe</td> <td>1 Woche</td></tr>
                <tr><td>Views schreiben</td> <td>Hendrik, Robin</td> <td>4 Wochen</td></tr>
                <tr><td>Styling der Views</td> <td>Hendrik, Robin</td> <td>4 Wochen</td></tr>
                <tr><td>Ideen-Sammlung</td> <td>komplette Gruppe</td> <td>1.5 Wochen</td></tr>
                <tr><td>Ideen-Sammlung</td> <td>komplette Gruppe</td> <td>1.5 Wochen</td></tr>
                <tr><td>Ideen-Sammlung</td> <td>komplette Gruppe</td> <td>1.5 Wochen</td></tr>
                <tr><td>Ideen-Sammlung</td> <td>komplette Gruppe</td> <td>1.5 Wochen</td></tr>
            </tbody>



<!---
            <table>
                <thead>
                <tr><th>Tätigkeit</th>  <th>Zuständige Person</th>  <th>Benötigter Aufwand</th></tr>
                </thead>
                <tbody>
                <tr><td>Ideen-Sammlung</td>                     <td>komplette Gruppe   </td>        <td>1.5 Wochen</td></tr>
                <tr><td>Entwurf Mockups</td>                    <td>komplette Gruppe   </td>        <td>1 Woche</td></tr>
                <tr><td>Zeitplanung + Gantt</td>                    <td>komplette Gruppe   </td>        <td>0.5 Wochen</td></tr>
                <tr><td>Programmierung Grundlayout</td>         <td>Hendrik Lendeckel   </td>       <td>1 Woche</td></tr>
                <tr><td>Programmierung Log-In Page</td>         <td>Robin Harris</td>               <td>0.5 Wochen</td></tr>
                <tr><td>Programmierung Account-Pages</td>       <td>Hendrik Lendeckel  </td>        <td>0.5 Wochen</td></tr>
                <tr><td>Programmierung All Rental Page</td>     <td>Hendrik Lendeckel   </td>       <td>0.5 Wochen</td></tr>
                <tr><td>Umsetzung MVC-Pattern</td>              <td>Hendrik Lendeckel  </td>        <td>3 Wochen</td></tr>
                <tr><td>Programmierung Rental-Controller</td>   <td>Hendrik Lendeckel   </td>       <td>1 Woche</td></tr>
                <tr><td>Programmierung Admin-Controller</td>    <td>Hendrik Lendeckel  </td>        <td>1 Woche</td></tr>
                <tr><td>Programmierung Views: <ul>
                            <li>admin</li>
                            <li>booking</li>
                            <li>editEmployee</li>
                            <li>showEmployee</li>
                            <li>updatedEmployee</li>
                            <li>documentation</li>
                            <li>footer</li>
                            <li>header</li>
                            <li>home</li>
                            <li>imprint</li>
                            <li>privacy</li>
                            <li>addNewRental</li>
                            <li>newRental</li>
                            <li>showRental</li>
                        </ul></td>                    <td>Hendrik Lendeckel  </td>        <td>1 Woche</td></tr>

                <tr><td>Programmierung Model Functions: <ul>
                            <li>findByPersonID</li>
                            <li>updateAddress</li>
                            <li>findByRentalId</li>
                            <li>getResort</li>
                            <li>getAllEmployees</li>
                            <li>updateEmp</li>
                            <li>findByRentalId</li>
                            <li>getModeIDFromJob</li>
                            <li>updatePerson</li>
                            <li>updateModeID</li>
                            <li>getRentalPicturePath</li>
                            <li>getAllRental</li>
                            <li>getRentalType</li>
                            <li>findRentalsByFilter</li>
                            <li>getResortIdByResortName</li>
                            <li>getNumberOfKitchen</li>
                            <li>getTypeOfRentalOutdoorSeating</li>
                            <li>newRental</li>
                            <li>getChildClass</li>
                            <li>getMoreRentalsThen</li>
                            <li>getResortNameByID</li>
                            <li>getResortIDByName</li>
                        </ul></td>   <td>Hendrik Lendeckel   </td>       <td>1 Woche</td></tr>
                <tr><td>Datenbank Änderungen (neue Tabellen)</td>    <td>Hendrik Lendeckel & Max Schelenz </td>        <td>2 Woche</td></tr>
                </tbody>


        </table>
        -->
<!--        <h2>Aufteilung</h2>-->
<!--        <p>-->
<!--            Nach den Übungsstunden zum MVC Pattern haben wir uns gemeinschaftlich dafür entschieden,-->
<!--            die Aufgaben unter uns zu verteilen. Trotzdem hat natürlich jeder überall mit am Code geschrieben oder Optimierungen vorgenommen.-->
<!--            Robin kümmert sich um die Views, Dario und Hendrik haben die Controller untereinander aufgeteilt und-->
<!--            Max befasst sich mit den Models und den Anpassungen der Datenbank.-->
<!---->
<!--            Während des Entwicklungsprozesses sind uns kleinere Fehler aufgefallen, bspw. in der Datenbankstruktur oder in den logischen Abläufen.-->
<!--            In solchen Fällen wurde dann in der Gruppe oder mit dem Verantwortlichen Rücksprache gehalten, wie wir das Problem am besten lösen können-->
<!--            und im Anschluss wurde sich an das Bugfixing begeben, teilweise zu zweit oder zu dritt oder manchmal auch alleine, wenn der Lösungsweg klar war.-->
<!--        </p>-->
<!--        <img src="../assets/documentation/MVC/ordnerstruktur.png">-->
    </div>
</section>