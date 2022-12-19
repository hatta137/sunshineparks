<!--   AllObjects -->
<section class="allObjects">
    <div class="row">
        allRentals
        <?php foreach  ($allRentals as $rental): ;?>
        <div class="objectBox">
            <img src="../assets/graphics/Objekte/Usedom/Usedom1.jpg" alt="Haus Usedom 1">
            <div class="objectBoxText">
                <h2>Usedom Haus am Meer</h2>
                <table>
                    <tr>
                        <td>Schlafzimmer:</td>
                        <td><?= $rental[0]->Bedroom?></td>
                    </tr>
                    <tr>
                        <td>Bäder:</td>
                        <td><?= $rental[0]->Bathroom?></td>
                    </tr>
                    <tr>
                        <td>Küchen:</td>
                        <td>Küchen</td>
                    </tr>
                    <tr>
                        <td>Max. Gäste:</td>
                        <td><?= $rental[0]->MaxVisitor?></td>
                    </tr>
                    <tr>
                        <td>Quadratmeter:</td>
                        <td><?= $rental[0]->SqrMeter?></td>
                    </tr>
                </table>
                <a href="" class="btn">Buchen</a>
                <a href="" class="btn">Mehr</a>
            </div>
        </div>
        <?php endforeach; var_dump($allRentals)?>
    </div>
</section>
