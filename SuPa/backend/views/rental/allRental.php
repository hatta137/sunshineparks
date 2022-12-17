<!--   AllObjects -->
<section class="allObjects">
    <div class="row">
        <?php foreach ($allRentals as $rental): ?>
        <div class="objectBox">
            <img src="graphics/Objekte/Usedom/Usedom1.jpg" alt="Haus Usedom 1">
            <div class="objectBoxText">
                <h2>Usedom Haus am Meer</h2>
                <table>
                    <tr>
                        <td>Schlafzimmer:</td>
                        <td><?= $rental->Bedroom?></td>
                    </tr>
                    <tr>
                        <td>Bäder:</td>
                        <td><?= $rental->Bathroom?></td>
                    </tr>
                    <tr>
                        <td>Küchen:</td>
                        <td>Küchen</td>
                    </tr>
                    <tr>
                        <td>Max. Gäste:</td>
                        <td><?= $rental->MaxVisitor?></td>
                    </tr>
                    <tr>
                        <td>Quadratmeter:</td>
                        <td><?= $rental->SqrMeter?></td>
                    </tr>
                </table>
                <a href="" class="btn">Buchen</a>
                <a href="" class="btn">Mehr</a>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</section>
