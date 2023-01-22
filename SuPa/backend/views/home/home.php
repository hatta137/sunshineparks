<section class="topbox">
    <div class="header-content">
        <h1>Erlebe einen traumhaften Urlaub in unseren Resorts!</h1>
        <p>Wohin soll es gehen?</p>
        <form action="index.php" method="get">
            <label><input type="hidden" name="page" value="rental">     </label>
            <label><input type="hidden" name="view" value="showRental"> </label>
            <label><input type="hidden" name="show" value="filter">     </label>
            <label><select name="resort">
                <option value="Erfurt">Erfurt</option>
                <option value="Usedom">Usedom</option>
                <option value="Oberhof">Oberhof</option>
                <option value="Berchtesgaden">Berchtesgaden</option>
            </select></label>
            <label><input type="text" name="startDate" placeholder="von"
                   onfocus="(this.type='date')"
                   onblur="(this.type='text')"></label>
            <label><input type="text" name="endDate" placeholder="bis"
                   onfocus="(this.type='date')"
                   onblur="(this.type='text')"></label>
            <label><input type="number" name="numberOfGuests" min="0" max="16" placeholder="Anzahl der Reisenden"></label>
            <label><input type="submit" value="Suche"></label>
            <label><input type="button" onclick="window.location.href='index.php?page=rental&view=showRental&show=all'" value="Zeig Alle"></label>

        </form>
    </div>
</section>



<!--   About -->
<section id="aboutAnchor" class="about">
    <div class="row">
        <div class="about-left">
            <h2>Sunshine Parks ist dein Ferienerlebnis</h2>
            <img src="../assets/graphics/mainpagebanner/Berchtesgaden.jpg" alt="Berchtesgaden">
        </div>
        <div class="about-middle">
            <h2>Geschichte ist Leidenschaft</h2>
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
            <a href="" class="btn">Mehr erfahren</a>
        </div>
        <div class="about-right">
            <h2>Vision SunshinePark</h2>
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
            <a href="" class="btn">Mehr erfahren</a>
        </div>
    </div>
</section>

<!--    About 2-->
<section class="about2">
    <div class="row">
        <div class="about2-left">
            <h2>Wir sind für dich da!</h2>
            <h1>Über uns:</h1>
            <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            </p>
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidna aliquyam erat, sed diam voluptua?</p>
        </div>
        <div class="about2-right">
            <div class="row">
                <div class="card">
                    <box-icon type="solid" name="ship" color="#48AC98" size="60px"></box-icon>
                    <h2>USD</h2>
                </div>
                <div class="card">
                    <box-icon type="solid" name="city" color="#48AC98" size="60px"></box-icon>
                    <h2>EF</h2>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <box-icon type="solid" name="tree" color="#48AC98" size="60px"></box-icon>
                    <h2>OH</h2>
                </div>
                <div class="card">
                    <box-icon name="cable-car" color="#48AC98" size="60px"></box-icon>
                    <h2>BGD</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<!--    process -->
<section class="process">
    <div class="row">
        <h1>Wie funktioniert eine Buchung?</h1>
    </div>
    <div class="row">
        <div class="process-content">
            <div class="progress-bar">
                <div class="c1"></div>
                <div class="c2"></div>
                <div class="c3"></div>
            </div>
            <div class="row">
                <div class="box1">
                    <h2>Resort wählen</h2>
                    <p>Such dir eines unserer schönen Resorts aus!</p>
                </div>
                <div class="box2">
                    <h2>Buchen</h2>
                    <p>Nenn uns deine Buchungsdetails ;-)</p>
                </div>
                <div class="box3">
                    <h2>Anreisen und Abschalten</h2>
                    <p>Genieß deinen Urlaub bei uns!</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!--   Testimony -->
<section class="testimony">
    <div class="row">
        <div class="test">
            <div class="image">
                <img src="../assets/graphics/Testimonial/Mann.jpeg" alt="MannLeft">
            </div>
            <div class="test-content">
                <p>Suuuuper Geil und alles hier.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod</p>
                <h2>Heinz Halslos</h2>
                <div class="icons">
                    <box-icon name="star" type="solid" color="whitesmoke"></box-icon>
                    <box-icon name="star" type="solid" color="whitesmoke"></box-icon>
                    <box-icon name="star" type="solid" color="whitesmoke"></box-icon>
                    <box-icon name="star-half" type="solid" color="whitesmoke"></box-icon>
                </div>
            </div>
        </div>
        <div class="test">
            <div class="image">
                <img src="../assets/graphics/Testimonial/Frau.jpeg" alt="FrauRight">
            </div>
            <div class="test-content">
                <p>Läässig!.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod</p>
                <h2>Birgitt Schmitt</h2>
                <div class="icons">
                    <box-icon name="star" type="solid" color="whitesmoke"></box-icon>
                    <box-icon name="star" type="solid" color="whitesmoke"></box-icon>
                    <box-icon name="star" type="solid" color="whitesmoke"></box-icon>
                    <box-icon name="star-half" type="solid" color="whitesmoke"></box-icon>
                </div>
            </div>
        </div>
    </div>
</section>

<!--    Contact-->
<section class="contact">
    <div class="row">
        <h1>Nimm Kontakt zu uns auf!</h1>
    </div>
    <div class="row">
        <form>
            <label><input type="text" placeholder="Dein Name" id="ContactformularName" required>           </label>
            <label><input type="email" placeholder="Deine E-Mailadresse" id="ContactformularMail" required></label>
            <label><textarea placeholder="Deine Nachricht" id="ContactformularText" required></textarea></label>
            <input type="submit" value="Absenden" onclick="Myfunction()" >
        </form>
    </div>
</section>

<script>
    function Myfunction() {
            alert("Vielen Dank. Ihre Anfrage wird in Kürze bearbeitet.")
    }

</script>


