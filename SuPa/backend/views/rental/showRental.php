
<script src="../assets/javascript/showRental.js"></script>





<section class="allObjects">
    <div class="row">

        <?php for  ($i = 0; $i < count($allRentals); $i++):
            $rental = $allRentals[$i];


            ?>
            <div class="objectBox">
                <!--            TODO Anpassen der Bilder -->
                <img src="<?php echo $allRentalAttributes[$i]['Path']?>" alt="<?=$allRentalAttributes[$i]['Path']?>" >

                <div class="objectBoxText">
                    <h2><?= $allRentalAttributes[$i]['Type'] ?></h2>
                    <table>
                        <tbody>
                        <tr><td>Schlafzimmer:</td><td><?= $rental->Bedroom?></td></tr>
                        <tr><td>Bäder:</td><td><?= $rental->Bathroom?></td></tr>
                        <tr><td>Küchen:</td><td><?=$allRentalAttributes[$i]['Kitchen']?></td></tr>
                        <tr><td>Max. Gäste:</td><td><?= $rental->MaxVisitor?></td></tr>
                        <tr><td>Quadratmeter:</td><td><?= $rental->SqrMeter?></td></tr>
                        <tr><td><?= $allRentalAttributes[$i]['OutdoorSeating']?></td></tr>
                        </tbody>
                    </table>
                    <a class="btn">Buchen</a>
                    <a class="btn">Mehr</a>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</section>

