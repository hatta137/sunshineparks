<!--   AllObjects -->
<section class="allObjects">
    <div class="row">
        allRentals
        <?php foreach  ($allRentals as $rental):
                foreach ($rental as $items) :
            ?>
        <div class="objectBox">
            <img src="../assets/graphics/Objekte/Usedom/Usedom1.jpg" alt="Haus Usedom 1">
            <div class="objectBoxText">
                <h2>Usedom Haus am Meer</h2>
                <table>
                    <tr>
                        <td>Schlafzimmer:</td>
                        <td><?= $items->Bedroom?></td>
                    </tr>
                    <tr>
                        <td>Bäder:</td>
                        <td><?= $items->Bathroom?></td>
                    </tr>
                    <tr>
                        <td>Küchen:</td>
                        <td>Küchen</td>
                    </tr>
                    <tr>
                        <td>Max. Gäste:</td>
                        <td><?= $items->MaxVisitor?></td>
                    </tr>
                    <tr>
                        <td>Quadratmeter:</td>
                        <td><?= $items->SqrMeter?></td>
                    </tr>
                </table>
                <a href="" class="btn">Buchen</a>
                <a href="" class="btn">Mehr</a>
            </div>
        </div>
        <?php
                endforeach;
                endforeach; ?>
    </div>
</section>
