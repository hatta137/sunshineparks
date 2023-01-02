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
        </ul>
        <h2>Reflektion</h2>
        <ul>
            <li><a class="index-link" href=""></a>Herausforderungen und deren Lösung</li>
            <li><a class="index-link" href=""></a>Besonderheiten</li>
            <li><a class="index-link" href=""></a>Projektmanagement</li>
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
        <p>Des weiteren fanden wir das minimalistische Design ansprechend und waren vom responsive-design überzeugt.</p>
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
            Hinter dem Layout steht eine Kombination aus Flex-Boxen. Jede Seite ist in drei Bereiche aufgeteil.
            Header (inkl. Navbar), Main-Section (Je variert je nach Seite about, testimony, contact, ...) und footer.
            In der Navbar befinden sich Logo (inkl. Link auf Index-Seite), Firmenname und den eigentlichen Navigationselementen
            in Form einer verlinkenden Liste. Durch ein gleichbleibendes Hintergrundbild in der Headersection, bekommt jede Seite
            einen einheitlichen Start. Der Footer ist auf jeder Seite gleich und enthält Navigationselemente zu den Seiten Impressum,
            Kontakt, Datenschutz und den Nutzungsbedingungen.
        </p>
        <h2>Verlinkung/Navigationsstruktur</h2>
        <p>Bild einfügen</p>

    </div>
</section>

<section id="siteDesign" class="even">
    <div>
        <h1>Design</h1>
        <h2>Layout</h2>
        <p>
            Beim Layout haben wir uns dafür entschieden eine moderne Anordnung zu verwenden. Beginnend mit einem Header,
            welcher das Firmenlogo, den zentrierten Firmenname sowie die Navbar enthält.
            Der Content-Bereich schließt sich bündig ab und unterteilt sich in verschiedene Sektionen.
            Der Footer beginnt direkt nach dem Ende des Conent-Bereichs und stellt das Ende der aufgeurfenen Webseite dar.
        </p>
        <h2>Farben</h2>
        <p>
            Unsere Hauptfarben sind Hellblau (Oceans Green und Keppel), sowie die Kontrastfarben Schwarz (Mine Shaft) und Weiß (White Sands).
            Im Content-Bereich unterteilen wir unsere inhaltlichen Sections mit heller und dunkler Farbgebung.
        </p>
        <h2>Formen</h2>
        <p>
            Buttons versuchen wir möglichst einheitlich aus einer Bibliothek zu verwenden und im grafischen Design orientieren wir uns
            an unseren Haupt und Nebenfarben, um ein einheitliches, modernes Gesamtbild der Webseite zu präsentieren.
        </p>
        <h2>Schrift</h2>
        <p>
            Als Schriftart verwenden wir beau.tff - diese hat uns besonders durch ihre geschwungenen Bögen und gute Lesbarkeit überzeugt.
        </p>
        <h2>Positionierung</h2>
        <p>
            Das Firmenlogo soll stets oben links auf der Webseite positioniert werden, Grafiken und Icon sollen verhältnismäßig mit den
            anderen Inhalten zusammen mittig abgebildet sein und ein zentriertes Gesamtbild ergeben.
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
            @robin bitte hier dein Part ergänzen
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
        <img src="fertiges ER-Modell ergänzen!!!">
    </div>
</section>

<section id="reMod" class="odd">
    <div>
        <h1>Relationales Modell</h1>
        <img src="fertiges relationales Modell ergänzen!!!">
    </div>
</section>

<section id="roleMod" class="even">
    <div>
        <h1>Rollenmodell</h1>
        <img src="fertgies Rollenmodell ergänzen!!!">
    </div>
</section>

<section id="dataInput" class="odd">
    <div>
        <h1>Flussbild Dateneingabe</h1>
        <img src="fertiges Flussbild ergänzen!!!">
    </div>
</section>

<section id="mvcPattern" class ="even">
    <div>
        <h1>MVC Pattern</h1>
        <img src="graphics\MVC-Pattern.jpg" alt="MVC-Pattern Umsetzung">
        <h2>Aufteilung</h2>
        <p>
            Nach den Übungsstunden zum MVC Pattern haben wir uns gemeinschaftlich dafür entschieden,
            die Aufgaben unter uns zu verteilen.
            Robin kümmert sich um die Views, Dario und Hendrik haben die Controller untereinander aufgeteilt und
            Max befasst sich mit den Models und den Anpassungen der Datenbank.

            --Hier noch ein Ausschnitt aus der Ordnerstruktur unseres MVC Patterns ergänzen.
        </p>

        <h2>Architektur</h2>
        <p>
            Hier müssen die Zusammenhänge und wichtigsten Funktionalitäten im MVC erklärt werden.
        </p>
    </div>
</section>

