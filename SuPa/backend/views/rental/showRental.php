




<section class="allObjects">
    <div class="row">

        <?php for  ($i = 0; $i < count($allRentals); $i++):
            $rental = $allRentals[$i];


            ?>
            <div class="objectBox">
                <!--            TODO Anpassen der Bilder -->
                <img src="<?php echo $rentalPicturePaths[$i]?>" alt="<?=$rentalPicturePaths[$i]?>" >

                <div class="objectBoxText">
                    <h2><?= $rentalTypes[$i] ?></h2>
                    <table>
                        <tr><td>Schlafzimmer:</td><td><?= $rental->Bedroom?></td></tr>
                        <tr><td>Bäder:</td><td><?= $rental->Bathroom?></td></tr>
                        <tr><td>Küchen:</td><td><?=$rentalKitchen[$i]?></td></tr>
                        <tr><td>Max. Gäste:</td><td><?= $rental->MaxVisitor?></td></tr>
                        <tr><td>Quadratmeter:</td><td><?= $rental->SqrMeter?></td></tr>
                        <tr><td><?= $rentalOutdoorSeating[$i]?></td></tr>
                    </table>
                    <a href="" class="btn">Buchen</a>
                    <a href="" class="btn">Mehr</a>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</section>
