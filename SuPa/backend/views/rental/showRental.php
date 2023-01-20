
<script src="../assets/javascript/showRental.js"></script>





<section class="allObjects">
    <div class="row">

        <?php for  ($i = 0; $i < count($allRentals); $i++):
            $rental = $allRentals[$i];


            ?>
            <div class="objectBox">

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
                    <input type="button"  value="BUCHEN">
                    <input type="button"  value="MEHR">
                </div>
            </div>
        <?php endfor; ?>
    </div>
</section>

