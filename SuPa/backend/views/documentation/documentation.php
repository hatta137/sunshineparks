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

<div class="documentation">
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
            große Kapazitäten im Bezug auf die Wohnungen und Häuser. Organisatorisch ist die Sunshine
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
        <h2>Ziele des Projekts</h2>
        <p>
            Dieses Projekt beschränkt sich auf die folgenden Funktionalitäten:
        </p>
        <div>
            <ul>
                <li>Login für Gäste, Mitarbeiter und Administratoren</li>
                <li>Darstellung der Mietobjekte (mit Filteroption)</li>
                <li>Editieren der Mitarbeiter durch den Administrator</li>
                <li>Anlegen der Mietobjekte durch den Objektverwalter</li>
                <li>Löschen des eigenen Kontos durch einen Gast</li>
            </ul>
        </div>
    </div>
</section>

<section id="resProj" class="even">
    <div>
        <h1>Recherche</h1>

        <h2>Ähnliche Websiten</h2>

        <h3>1. airbnb</h3>
        <p><a href="https://www.airbnb.de/" target=”_blank”>Link zur Website airbnb</a></p>
        <p>An der airbnb-Website hat uns das Design der einzelnen Unterkünfte und deren Anordnung (Kacheln) sehr gut gefallen.
        Des weiteren fanden wir das minimalistische Design ansprechend und waren vom responsive-Design überzeugt.</p>
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

        <img src="../assets/documentation/Layout/Header.png" alt="Header der Webseite">


        <h3>Main-Section</h3>
        <h4>Bsp. Startseite</h4>

        <ul id="main-section-gallery">
            <li><label><span>Topbox</span></label><img src="../assets/documentation/Layout/Filterbox.png" alt="Filterbox in der Main-Section"></button></li>
            <li><label><span>About</span></label><img src="../assets/documentation/Layout/Content-Boxen-main.png" alt="Informationen über SunshineParks"></button></li>
            <li><label><span>Process</span></label><img src="../assets/documentation/Layout/Process.png" alt="Informationen zum Buchungsablauf und Kundenbewertungen"></button></li>
            <li><label><span>Testimony</span></label><img src="../assets/documentation/Layout/testimony.png" alt="Formular zur Kontaktaufnahme"></button></li>
            <li><label><span>Contact</span></label><img src="../assets/documentation/Layout/Kontaktbox.png" alt="Footer der Webseite"></button></li>
        </ul>


        <h3>Footer</h3>

        <img src="../assets/documentation/Layout/Footer.png" alt="Header der Webseite">


        <h4>Beschreibung</h4>
        <p>
            Das Layout basiert auf einer Kombination von Flex-Boxen und ist in drei Bereiche unterteilt: Header (inklusive Navbar),
            Main-Section (die je nach Seite unterschiedlich ist, z.B. About, Testimony, Contact, Administration) und Footer.
            Im Header befinden sich das Logo (mit einem Link zur Index-Seite), die Headline und die Navigationselemente in Form einer verlinkten Liste.
            Ein Line-Gradient wird über dem Hintergrundbild der Topbox platziert und generiert einen schattigen Effekt.
            In der Topbox befindet sich auch die Filterbox für die Rentals. Die About-Page präsentiert die Vision und Historie der SunshineParks.
            Im Abschnitt "Process" erklären wir, wie der Buchungsvorgang funktioniert. Testimonials wurden eingebaut,
            um Besuchern der Webseite Rezensionen zu präsentieren.
            Am Seitenende befindet sich ein Kontaktformular.
            Der Footer enthält Navigationselemente zu Impressum, Kontakt, Datenschutz und Nutzungsbedingungen.
        </p>

        <h2>Verlinkung/Navigationsstruktur</h2>
        <p>
            Beim Aufruf unserer Website gelangt man zunächst auf die index.php.
            Dort hat der Nutzer nun die Möglichkeit in der Navbar die Navigationselemente wie bsp. Account zu nutzen, um in den Accountbereich mit Login und Registrierung zu gelangen,
            um sein Nutzerkonto anzulegen oder zu verwalten.
        </p>
        <img class="AutoWidth" src="../assets/documentation/Layout/NavigationselementeHeader.png" alt="Navigationselemente Help, About und Account im Header">
        <p>
            Ist der Nutzer angemeldet werden ihm im Accountbereich je nachdem welche Rolle und Rechte seinem Account zugewiesen sind verschiedene Funktionalitäten und Unterseiten angezeigt,
            auf welche er Zugriff erhält und sich durch Betätigen der jeweiligen Buttons zwischen den Seiten navigieren kann. <br>

            Durch das Anklicken des Logos oder der Überschrift im Header wird der Nutzer egal, auf welcher Seite er sich aktuell befindet direkt zur index.php geleitet.
            Das soll unseren Nutzern ermöglichen schnellstmöglich zur Hauptseite unserer Webseite zu gelangen.

            Unsere Hauptseite enthält zu Beginn eine Filterbox, in welcher der Nutzer die Möglichkeit hat Filterkriterien einzugeben oder sich direkt alle Rentals anzeigen zu lassen.
            Mittels dieser Suchkriterien gelangt der Nutzer in den Buchungsbereich. Wo er sich dafür entscheiden kann ein Objekt was ihm gefällt zu Buchen oder sich mehr Informationen zum Rental anzeigen zu lassen.
            (Diese Bereiche des Buchungsvorgangs decken wir mit unserer Website jedoch nicht ab).
        </p>
        <img src="../assets/documentation/DB_Diagrams/SitemapingForAGuest.png" alt="SiteMapGuest">
        <p>
            Die gezeigte Sitemap stellt alle aufrufbaren Seiten aus der Sicht einen Guests dar und dient dazu einen Überblick der Navigationsstruktur bereitzustellen. Rot hinterlegte Seiten enthalten keine weitere Funktionalität, grün hinterlegte Seiten dagegen schon.
        </p>

    </div>
</section>

<section id="siteDesign" class="even">
    <div>
        <h1>Design</h1>
        <h2>Layout</h2>
        <p>
            Das Grundlayout jeder Seite besteht aus einem Header (inklusive Navbar), einem Content-Bereich für die dynamisch erzeugten Bestandteile und einem Footer.
        </p>
        <h3>Header:</h3>
        <p>Der Header enthält in der linken oberen Ecke das Firmenlogo, zentriert den Firmennamen sowie rechtsbündig die Navigationselemente.</p>
        <br>
        <h3>Content:</h3>
        <p>Der Content-Bereich wird auf jeder Seite unterschiedlich eingeleitet, schließt jedoch bündig am Header an und unterteilt sich in verschiedene Sektionen.</p>
        <br>
        <h3>Footer:</h3>
        <p>Der Footer, der direkt nach dem Content-Bereich beginnt, markiert das Ende der Webseite.</p>
        <br>
        <p>Das Layout der Startseite beinhaltet zusätzlich folgende Bereiche:
            About, About2, Process, Testimony und Contact.</p>


        <h2>Farben</h2>
        <img class="AutoWidth" src="../assets/documentation/Style/Colours/colours.png" alt="Primär-und Sekundärfarben der SunshineParks Webseite">
        <p>
            Die Primärfarben unserer Webseite sind Keppel #48ac98 und Mine Shaft #222222.
            Keppel wird vor allem für Buttons und farbliche Hervorhebungen genutzt.
            Mine Shaft wird für Footer, Header und Hintergründe verwendet, aber auch für Text, da wir Farbinvertierung zur Aufteilung der Sections verwenden.
            Als Sekundärfarbe verwenden wir White #ffffff für Text und Hintergründe.
        </p>
        <h2>Formen</h2>
        <img class="AutoWidth" src="../assets/documentation/Style/Icons/icons.png" alt="Beispiel für verwendete Icons im Content-Bereich">
        <p>
            Die verwendeten Formen stammen alle aus einer Designerbibliothek von Bocicons.com, um einheitliche Motive verwenden zu können. Das Logo, sowie die verwendeten Icons
            folgen alle demselben Stil, um ein stimmiges Gesamtbid zu erzeugen.
        </p>
        <h2>Schrift</h2>
        <img class="AutoWidth" src="../assets/documentation/Style/Fonts/font.png" alt="beau.tff Fontbeispiel">
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
        <h2>home</h2>
        <p>
            Die Startseite besteht aus dem Suchbereich für die Ferienhäuser und Apartments und einem Informationsbereich über das Unternehmen und die Ferienresorts.
            Im Suchbereich hat der User zwei Möglichkeiten sich diese Objekte anzeigen zu lassen:
            <br>
            1. Alle existierenden Objekte
            <br>
            2. Objekte die den Filterangaben entsprechen


        </p>

        <h2>authentication</h2>
        <p>
            Die Anmeldeformulare sollen eine minimalistische und übersichtliche Gestaltung aufweisen, um Nutzern eine intuitive Navigation zu ermöglichen.
            Es gibt eine Schaltfläche, die zwischen dem Login für Gäste und dem Login für den internen Bereich wechselt. Gäste melden sich über die
            "Login"-Schaltfläche an, während andere Rollen sich über ein internes Formular anmelden (siehe <a href="#roleMod">Rollenmodell</a>).
        </p>
        <h2>registration</h2>
        <p>
            Das Registrierungsformular ist ähnlich wie das Loginformular aufgebaut. Die Eingabefelder sind nach Kategorie in Containern (InputBox) sortiert.
            Durch die flex-wrap Eigenschaften sind die Container im Desktop-Vollbild nebeneinander und in der mobilen Ansicht untereinander angereiht.
            Unterhalb gibt es die Möglichkeit über einen Button zum Login zu wechseln.
        </p>
        <h2>showRental</h2>
        <p>
            Je nach Angabe im home-View wird der showRental View generiert. Die einzelnen, mietbaren Ferienhäuser und Apartments sind in Boxen dargestellt.
            In diesen Boxen ist ein Objekt-Foto sowie die grundlegenden Informationen aufgelistet. Diese wären Anzahl der Schlafzimmer, Bäder, Küchen, maximalen Gäste und Quadratmeter.
            Außerdem wird dynamisch angezeigt, ob es sich um ein Apartment oder um ein Haus handelt und je nach Resort, ob es sich in den Bergen, der Stadt oder am Meer befindet.
            Die letzte Information gibt Auskunft über das Vorhandensein einer Sitzmöglichkeit im Freien. Ein Haus kann eine oder keine Terrasse besitzen. Ein Apartment einen oder keinen
            Balkon. In jeder Box befinden sich zusätzlich zwei Buttons: "Buchen" und "Mehr". Diese haben bislang keine Funktion und sollen nur dem vollständigen Design dienen.
        </p>
        <h2>imprint</h2>
        <p>
            Das Impressum wurde durch https://www.e-recht24.de/impressum-generator.html generiert. Die angegebenen Daten entsprechen der fiktiven Firma Sunshine Parks GmbH.
        </p>
        <h2>privacy</h2>
        <p>
            Die Datenschutzangaben wurden durch https://datenschutz-generator.de/ generiert. Die angegebenen Daten entsprechen der fiktiven Firma Sunshine Parks GmbH.
        </p>
    </div>
</section>


<section id="erMod" class="even">
    <div>
        <h1>ER-Modell</h1>
        <img class="AutoWidth" src="../assets/documentation/DB_Diagrams/svg_ERMv12.drawio.svg" alt="Entity-Relationship-Modell">
        <p>
            Unser ER-Modell ist farblich in die verschiedenen Hauptbereiche unserer Webseite unterteilt, um die Tabellen besser zu differenzieren und zuzuordnen.
            Die Bereiche Accountverwaltung/Administration, Buchungsverwaltung und Objektverwaltung sind Bestandteile unseres Projekts.
            STRUCCHANGE, CRAFTSERVICE, MAINTENANCE und CLEANING sind Teil unseres Kontexts.
            Das ER-Modell war am Anfang einfacher gehalten, aber während der Projektarbeit haben wir festgestellt, dass eine genaue Übernahme des Datenbankmodells aus dem vorherigen Modul DB2 nicht möglich war.
            Es kam immer wieder zu strukturellen Veränderungen in der Datenbank, um die Abläufe zu realisieren oder wir haben die Tabellen optimiert, um die Programmlogik zu realisieren.
            Hierbei sind der PasswordHash oder der AccountType in der Tabelle PERSON zu nennen.
            Personmode und Mode wurden durch den Registrierungs- und Authentifizierungsbereich benötigt, der im vorherigen Semester noch außerhalb unseres Scopes lag und nun ergänzt werden musste.
            Die Erstellung der Rollen- und Rechte-Matrix sowie die parallelen Anpassungen der CSV-Imports und des Tabellenmodells sind weitere immer wiederkehrende Arbeitsschritte in unserem Projekt.
            CRAFTSERVICE, STRUCCHANGE, CLEANING und MAINTENANCE sind Relikte des 2.Semesters und befinden sich nicht in unserem Scope.
        </p>
    </div>
</section>

<section id="reMod" class="odd">
    <div>
        <h1>Relationales Modell</h1>
        <p>
            Die folgenden Tabellenmodelle sind alle zum besseren Verständnis den verschiedenen Scopes aus dem ER-Modell zugeordnet und enthalten alle wichtigen Informationen wie Spaltenname, verwendeter Datentyp, Null-Option und Bedingungen.
            Ebenso aufgelistet sind die Tabelle die sich nicht im Scope befinden, sondern zum Kontext gehören. Diese erkennt man an dem fehlenden farblichen Scoperahmen aus dem ERM.
        </p>
        <h2>Administration und Accountverwaltung</h2>
        <img src="../assets/documentation/DB_Diagrams/Tabellenmodell_Administration_Accountverwaltung.png" alt="Tabellenmodell">

        <h2>Buchungsverwaltung</h2>
        <img src="../assets/documentation/DB_Diagrams/Tabellenmodell_Buchungsverwaltung.png" alt="Tabellenmodell">

        <h2>Objektverwaltung</h2>
        <img src="../assets/documentation/DB_Diagrams/Tabellenmodell_Objektverwaltung.png" alt="Tabellenmodell">

        <h2>OutOfScope Tabellen</h2>
        <img src="../assets/documentation/DB_Diagrams/Tabellenmodell_OutOfScopeTables.png" alt="Tabellenmodell">
    </div>
</section>

<section id="roleMod" class="odd">
    <div>
        <h1>Rollenmodell</h1>
        <img src="../assets/documentation/DB_Diagrams/RollenRechteMatrix.png" alt="Rollen- und Rechtematrix">
        <p>
            Die Rollen-Rechte-Matrix zeigt die 8 verschiedenen Modes, die unser System benötigt.
            Admin, Cleaning, Maintenance, Manager, Rental, Booking, Guest und Viewer.
            Jeder Erstbesucher unserer Webseite hat automatisch die ModeID 8 und gilt als Viewer.
            Existiert lokal auf dem Gerät des Nutzers ein Cookie mit der SessionID, dann wird aus dem Session_Array die PersonID gelesen und das zugehörige Nutzerkonto eingeloggt mit den jeweiligen zugewiesenen Rechten.
            Meldet sich der Nutzer bei uns im System an, erhält er die Rechte die bei seinem Nutzerkonto hinterlegt sind.
            Die Nutzerrechte werden vor jedem Aufruf nochmals gecheckt und je nachdem ob der Nutzer die Rechte hat oder nicht, wird der Zugriff gewährt oder verweigert.
            Die komplette Rollen-Rechte-Matrix ist unter SuPa/assets/documentation/Files/Berechtigungen.xlsm zu finden.
        </p>
    </div>
</section>

<section id="dataInput" class="even">
    <div>
        <h1>Flussbild Dateneingabe</h1>
        <h2>Login und Registrierung</h2>
        <img class="AutoWidth" src="../assets/documentation/FlowCharts/Login_Registration.drawio.png" alt="Flussbilddiagramm des Logins und der Registrierung">
        <p>
            Der Besucher der Webseite hat die Möglichkeit, über das Registrierungsformular ein Nutzerkonto zu erstellen, falls er noch keines hat.
            Nach erfolgreicher Registrierung ist der Nutzer direkt mit seinem Konto angemeldet.
            Wenn bereits ein Konto vorhanden ist, wird dies entweder durch einen lokal gespeicherten Cookie erkannt und zugeordnet oder der Nutzer kann sich mit seinen Zugangsdaten im Login anmelden.
            In beiden Fällen erhält der Nutzer ein Feedback, indem im rechten oberen Bereich der Navbar "Hallo, -Vorname- " angezeigt wird.
        </p>

        <h2>Buchungsvorgang und Objektsuche</h2>
        <img class="AutoWidth" src="../assets/documentation/FlowCharts/Buchungsvorgang_Objektsuche.drawio.png" alt="Flussbilddiagramm des Buchungsvorgangs und der Objektsuche">
        <p>
            Ein Besucher der SunshineParks-Webseite kann sich mithilfe der Filterbox auf der Startseite (home.php) einen Überblick über die verfügbaren Unterkünfte in unseren Ferienresorts verschaffen.
            Hier hat er die Möglichkeit, die vorgegebenen Suchkriterien zu nutzen oder sich alle verfügbaren Unterkünfte anzeigen zu lassen.
            Es folgt eine Auflistung der gefilterten Unterkünfte, die dann gebucht werden können oder bei Interesse weitere Informationen angezeigt werden können.
            Der tatsächliche Buchungsvorgang wird in unserem Projekt jedoch nicht weiter abgedeckt.
        </p>
        <h2>Administration und Accountverwaltung</h2>
        <img class="AutoWidth" src="../assets/documentation/FlowCharts/Verwaltung_Administration.drawio.png" alt="Flussbilddiagramm der Administration und Verwaltung">
        <p>
            Um auf die Funktionen der Administration/Accountverwaltung zugreifen zu können, muss sich der Nutzer anmelden und danach, je nach seinen Zugriffsrechten, den Accountbereich aufrufen.
            Er hat dann Zugriff auf die verschiedenen Funktionalitäten, indem er die jeweiligen Buttons auswählt.
            Im FlowChart-Diagramm sind die funktional verfügbaren Buttons grün markiert, während die nicht verfügbaren Buttons rot gekennzeichnet sind und momentan noch nicht von unserem System unterstützt werden.
        </p>
    </div>
</section>


<section id="mvcPattern" class ="odd">
    <div>
        <h1>MVC Pattern</h1>
        <h2>Allgemein</h2>
        <img class="AutoWidth" src="../assets/documentation/MVC/mvcpattern.png" alt="MVC-Pattern Aufteilung">


        <h1>Architektur</h1>

        <p>
            Bei diesem Projekt wurde das MVC-Muster verwendet, um die Navigation und die Anzeige von Inhalten zu steuern.
            Der Controller-Name (page), Action-Name (view) und Logic-Name (logic) werden aus der URL mithilfe der $_GET[ ]-Variable gelesen. Diese drei Parameter bestimmen, welche View mit welchen Informationen gerendert wird.
            Wenn diese Werte nicht zugeordnet werden können, wird eine Fehlerseite aufgerufen. Wenn kein Wert angegeben wird, wird der Benutzer immer zur Startseite (home.php) weitergeleitet.
            Ein Permission-Check wird vor dem Aufruf einer Seite durchgeführt, um sicherzustellen, dass der Benutzer das Recht hat, diese Seite anzuzeigen, insbesondere im internen Bereich, der nur von Mitarbeitern und Administratoren besucht werden darf.
        </p>
        <br>
        <p>
            Die meiste Logik wird in den Controllern verarbeitet, während die Models als Abbilder der Datenbanktabellen dienen und die Lese- und Schreibzugriffe auf diese übernehmen.
            Sie stellen auch Funktionen bereit, die von den Controllern genutzt werden, um einen einfachen Zugriff auf die Daten zu ermöglichen. Die Controller übergeben die Informationen an die Views als Array von Parametern.
            In den Views wird die Darstellung dargestellt und die Informationen werden mithilfe von PHP-For-Schleifen aus den Array-Parametern iteriert.
        </p>
        <br>
        <p>
            In den Grafiken wird dargestellt, wie die Zusammenarbeit von Views, Controllern und Models sowie die Verwendung von Datenbanken zum Lesen und Schreiben von Informationen aussehen.
            Im Projekt wurde sichergestellt, dass alle Datenbankzugriffe dem CRUD-Prinzip (Create, Read, Update, Delete) entsprechen.
            Das Erstellen von Daten wurde durch die Registrierungsfunktion abgedeckt, das Lesen von Daten nimmt den größten Teil ein und ist in jedem Model implementiert.
            Das Aktualisieren von Daten wurde durch die Funktion "editEmployee" umgesetzt und Gäste können ihr Konto mit der Löschfunktion löschen.
        </p>

        <h2>Rental</h2>
        <p>Nachfolgend sind die Zusammenhänge im Bereich Rental dargestellt:</p>
        <img src="../assets/documentation/MVC/mvc-rental.png" alt="MVC-Rental">

        <h2>Admin</h2>
        <p>Nachfolgend sind die Zusammenhänge im Bereich Administration dargestellt:</p>
        <img src="../assets/documentation/MVC/mvc-admin.png" alt="MVC-Admin">

        <h2>Authentication</h2>
        <p>Nachfolgend sind die Zusammenhänge im Bereich Authentification dargestellt:</p>
        <img src="../assets/documentation/MVC/mvc-authentication.png" alt="MVC-Authentification">

        <h2>Account</h2>
        <p>Nachfolgend sind die Zusammenhänge im Bereich Account dargestellt:</p>
        <img src="../assets/documentation/MVC/mvc-account.png" alt="MVC-Account">

        <h2>Registration</h2>
        <p>Nachfolgend sind die Zusammenhänge im Bereich Registration dargestellt</p>
        <img src="../assets/documentation/MVC/mvc-registration.png" alt="MVC-Registration">

        <h2>Permission</h2>
        <p>Nachfolgend sind die Zusammenhänge im Bereich Permissions dargestellt:</p>
        <img src="../assets/documentation/MVC/mvc-permission.png" alt="MVC-Permissions">

        <h2>Documentation</h2>
        <p>
            Der View documentation.php wird über den Controller documentation.php aufgerufen.
        </p>

        <h2>Error</h2>
        <p>Die verschiedenen Error Views werden je nach Fehler aufgerufen. Es gibt die Fälle: Seite nicht existent, Kein Zugriffrecht, Fehlendes Recht, Passwort Falsch, Passwortwiederholung nicht übereinstimmend und Nutzer nicht existent</p>

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
            Die größte Herausforderung bei diesem Projekt war die Implementierung des MVC-Patterns, da unser Projekt zuvor statisch und nur nach HTML-Seiten unterteilt war.
            Unsere Gruppe musste aufgrund unseres Mangels an Erfahrung mit diesem Programmier-Pattern von Anfang an lernen, wie man es umsetzt, was zu Verzögerungen in der Zeitplanung führte.
            Durch mehrere Programmier-Sprints und viel Selbststudium konnten wir das MVC-Pattern schließlich erfolgreich implementieren und gleichzeitig die Funktionen der Seiten programmieren.
            Dieses Pattern hat uns geholfen, die Arbeit unter den Gruppenmitgliedern besser zu verteilen und komplexe Probleme durch deren Zerteilung zu lösen.
        </p>

        <h2>CSS</h2>
        <p>
            Zu Beginn des Projekts erstellten alle Gruppenmitglieder mehrere Entwürfe der Seiten und einige dieser Mockups wurden sogar programmiert.
            Das finale Design wurde aus diesen Stücken zusammengestellt und dabei wurden auch andere Websites und Tutorials als Inspiration genommen.
            Dies führte dazu, dass jedes Mitglied unterschiedliche Ansätze bei der Adressierung der HTML-Sektionen und deren Elemente verwendete, was zu Problemen mit dem CSS-Code führte.
            Erst durch die Neuaufteilung der Gruppe und die Zuteilung von Robin Harris als verantwortlichen für das Frontend-Design und die optische Anpassung der Views konnte ein optisch ansprechendes Ergebnis erzielt werden.
            Trotzdem ist sich die Gruppe einig, bei zukünftigen Web-Projekten anders an den Frontend-Teil heranzugehen, indem eine einheitliche Adressierung und Arbeitsweise verwendet werden, um mögliche Probleme zu vermeiden.
        </p>
        <h2>Datenbank-Importskripte</h2>
        <p>
            Eine große Herausforderung war es, die Importskripte für die Erstellung eines Datenbankbackups erfolgreich zu importieren.
            Auf einer Windows-Maschine gab es immer wieder Probleme mit Fremdschlüsseln oder eingetragenen Werten.
            Auf Linux hingegen liefen die erstellten Skripte problemlos und wir konnten das Datenbankbackup ohne Schwierigkeiten erstellen.
            Daher musste zusätzlich eine Linux-VM mittels VirtualBox installiert werden, um die Importskripts zuverlässig erstellen zu können.
        </p>
    </div>
</section>


<section id="besonderheiten" class="odd">
    <div>
        <h1>Besonderheiten & Known Bugs</h1>

        <h2>Datenbank Import</h2>
        <p>
            Auf einigen Linux Systemen, die wir getestet haben, musste ein mysql_upgrade durchgeführt werden. Erst dann konnte die Datenbank vollständig importiert werden.
        </p>

        <h2>Rechte für Fileupload</h2>
        <p>
            Auf dem getesteten Linux System mussten die Rechte angepasst werden, damit php Bilder in den richtigen Ordner verschieben darf.
            Dies ist erforderlich für die addNewRental.php.
            Folgender Befehl wurde verwendet:
            sudo find /opt/lampp/htdocs/assets/graphics -type d -exec chmod 777 '{}' \;
        </p>

        <h2></h2>
    </div>
</section>

<section id="projektmanagement" class="even">
    <div>
        <h1>Projektmanagement</h1>

<!--        Tabelle mit Tätigkeit / zuständiger Person / benötigtem Aufwand-->

        <p>
            In der folgenden Tabelle sind die Tätigkeiten der einzelnen Gruppenmitglieder und deren Zeitaufwand aufgelistet.
            Ein Großteil der gelisteten Elemente verliefen Parallel. Deshalb konnte der zeitliche Aufwand nur grob aufgenommen werden.
            Auch die Grenzen der Zuständigkeit verschwimmen, da sich alle Gruppenmitglieder gegenseitig unterstützten.
        </p>
        <br/><br/>


            <table id="docTable">
                <thead>
                <tr><th>Tätigkeit</th>  <th>Zuständige Person</th>  <th>Benötigter Aufwand</th></tr>
                </thead>
                <tbody>
                <tr><td>Ideen-Sammlung</td>                     <td>komplette Gruppe   </td>        <td>1.5 Wochen</td></tr>
                <tr><td>Entwurf Mockups</td>                    <td>komplette Gruppe   </td>        <td>1 Woche</td></tr>
                <tr><td>Zeitplanung + Gantt</td>                    <td>komplette Gruppe</td>        <td>0.5 Wochen</td></tr>
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
                        </ul></td>                              <td>Hendrik Lendeckel  </td>        <td>1 Woche</td></tr>

                <tr><td>Programmierung Views: <ul>
                            <li>authenticationGuest</li>
                            <li>authenticationLogin</li>
                            <li>registration</li>
                            <li>header</li>
                        </ul></td>                              <td>Robin Harris  </td>        <td>1 Woche</td></tr>

                <tr><td>Styling der Views </td>                 <td>Robin Harris  </td>        <td>4 Wochen</td></tr>

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
                <tr><td>Datenbank Änderungen (neue Tabellen)</td>    <td>Hendrik Lendeckel & Max Schelenz </td>        <td>2 Wochen</td></tr>

                <tr><td>Programmierung der Model Functions: <ul>
                            <li>findByValues</li>
                            <li>findByPersonID</li>
                            <li>getChildClass</li>
                            <li>newPerson</li>
                            <li>deletePerson</li>
                            <li>deleteGuest</li>
                            <li>deleteAdmin</li>
                            <li>deleteEmployee</li>
                            <li>deletePersonMode</li>
                            <li>getAddressFromRental</li>
                        </ul></td>          <td>Max Schelenz</td>       <td>3 Wochen</td></tr>
                <tr><td>Bearbeitung der Datenbankdateien</td>   <td>Max Schelenz</td>   <td>2.5 Wochen</td></tr>
                <tr><td>Programmierung Grunddesign Documentation</td>   <td>Max Schelenz</td>   <td>1 Woche</td></tr>
                <tr><td>Design der Documentation Diagramme</td> <td>Max Schelenz</td> <td>1.5 Wochen</td></tr>
                <tr><td>Umbau MVC-Pattern Models</td><td>Max Schelenz</td><td>3 Wochen</td></tr>
                <tr><td>Troubleshooting Datenbank/Models</td>   <td>Max Schelenz</td>   <td>2 Wochen</td></tr>
                <tr><td>Programmierung Controller MVC-Pattern: <ul>
                            <li>account-controller</li>
                            <li>authentication-controller</li>
                            <li>error-controller</li>
                            <li>registration-controller</li>
                        </ul></td><td>Dario Daßler</td><td>3.5 Wochen</td></tr>
                <tr><td>Permission-Core Klasse</td> <td>Dario Daßler</td> <td>2 Wochen</td></tr>
                <tr><td>Error Views</td><td>Dario Daßler</td><td>3 Wochen</td></tr>
                <tr><td>Trello Organisation</td><td>Dario Daßler</td><td>3 Tage</td></tr>
                </tbody>


        </table>


    </div>
</section>

</div>