<?php
//TODO fixen
class RentalView extends view{


    static function showRental($rentals){
        print "<section class='allObjects'>";
        print "<div class='row'>";


        foreach ($rentals as $rental){
            print "<div class='objectBox'>";
            print "<img src='pfad' alt='description'>";
            print "<div class='objectBoxText'>";
            print "<h2> rental.type </h2>>";
            print "<table>";
            print "<tr><td>Schlafzimmer:</td>      <td>{$rental['bedroom']}</td></tr>";
            print "<tr><td>Bäder:</td>             <td>{$rental['bathroom']}</td></tr>";
            print "<tr><td>Küchen:</td>            <td>{$rental['kittchen']}</td></tr>";
            print "<tr><td>Max. Gäste:</td>        <td>{$rental['maxGuest']}</td></tr>";
            print "<tr><td>Quadratmeter:</td>      <td>{$rental['sqrtMeter']}</td></tr>";
            print "<tr><td>Sitzmöglichkeit:</td>   <td>{$rental['freeSeat']}</td></tr>";
            print "</table>";
            print "</div>";
            print "</div>";
        }
        print "</div>";
        print "</section>";






    }




    static function sendJSON($rental){
        print json_encode($rental);
    }



}