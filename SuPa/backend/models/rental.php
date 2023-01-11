<?php
require_once "appartment.php";
require_once "house.php";
require_once "address.php";
class Rental extends Model{




    public function __construct($rentalId)
    {
        parent::__construct('RENTAL', 'RentalID', $rentalId);
    }


    /***
     * Author: Hendrik Lendeckel
     * This method returns all rentals from the database
     * @return array of instances of the Objects Rental
     */
    public static function getAllRental() : array{
        $db = getDB();

        $stmt = $db->prepare('SELECT * FROM RENTAL');
        $stmt->execute();
        $result = $stmt->fetchAll();

        $rentals = array();

        foreach ($result as $rental){
            $rentals [] = new Rental($rental['RentalID']);
        }
        return $rentals;
    }


    /***
     * Author: Hendrik Lendeckel
     *
     * @return string with the right type of Rental (Apartment or House) and the right Location (Mountain/Ocean/City)
     */
    public function getRentalType() : string{
        $db = getDB();

        /**
         * This method accesses the instance variable RentalID and uses it to find out in the queries whether
         * the RentalID occurs in the APPARTMENT table or in the HOUSE table or in neither of the two.
         */

        $stmt1 = $db->prepare('SELECT RentalID FROM APPARTMENT WHERE RentalID = ?');
        $stmt2 = $db->prepare('SELECT RentalID FROM HOUSE WHERE RentalID = ?');
        $stmt1->execute([$this->RentalID]);
        $stmt2->execute([$this->RentalID]);
        $apartments = $stmt1->fetch();
        $houses = $stmt2->fetch();

        $typeOfRental = "";
        $typeOfLocation = "";

        if ($apartments){
            $typeOfRental = "Apartment ";
        } elseif ($houses){
            $typeOfRental = "Haus ";
        } else{
            return "No Rental found";
        }

        /** The correct location is requested here */

        if ($this->AreaID === 10){
            $typeOfLocation = 'am Meer';
        }elseif ($this->AreaID === 20){
            $typeOfLocation = 'in den Bergen';
        }elseif ($this->AreaID === 30){
            $typeOfLocation = 'in der Stadt';
        }

        return $typeOfRental.$typeOfLocation;
    }



    /***
     * Author: Hendrik Lendeckel
     * @param $resort
     * @param $startDate
     * @param $endDate
     * @param $numberOfGuests
     * @return array of instances of the Objects Rental
     */


    public static function findRentalsByFilter($resortName, $startDate, $endDate, $numberOfGuests) :array{
        $db = getDB();

        $resortID = self::getResortIdByResortName($resortName);

        /***
         * Uses the function fn_GetResortID(), which is stored in the database.
         * The name of a rental is transferred to this function and returns the appropriate RentalID
         */

        try {



            /***
             * This query provides us with all rentals which:
             *      1. have no bookings or
             *      2. have no booking in the desired period and
             *      3. are in the desired resort
             */

            $stmtRentals = $db->prepare('SELECT RENTAL.RentalID   FROM RENTAL
                                                                        LEFT JOIN BOOKINGDETAIL ON RENTAL.RentalID = BOOKINGDETAIL.RentalID 
                                                                        LEFT JOIN BOOKING ON BOOKING.BookingID = BOOKINGDETAIL.BookingID 
                                                                        AND     (BOOKING.EndDateRent < ? OR BOOKING.StartDateRent > ?)
                                                                        
                                                                        JOIN RESORT ON RESORT.ResortID = RENTAL.ResortID
                                                                        WHERE   RENTAL.MaxVisitor >= ?
                                                                        AND     RENTAL.ResortID = ?
                                                                        AND		BOOKING.BookingID IS null;');
            $stmtRentals->execute([$startDate, $endDate, $numberOfGuests, $resortID]);
            $rentalIDs = $stmtRentals->fetchAll();

            $rentals = array();
            foreach ($rentalIDs as $rentalID){
                $rentals [] = new Rental($rentalID['RentalID']);
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }

        return $rentals;
    }


    public static function getResortIdByResortName($resortName) :int{
        $db = getDB();


        $stmtGetResortID = $db->prepare('SELECT fn_GetResortID(?) AS ID');
        $stmtGetResortID->execute([$resortName]);
        $resortID = $stmtGetResortID->fetch()['ID'];

        return $resortID;
    }




    /***
     * Author: Hendrik Lendeckel
     * @return int the Number of Kitchens in the Rental
     */

    public function getNumberOfKitchen() :int{

        $typeOfRental = substr($this->getRentalType(), 0, 4);


        /** A Apartment has no kitchens */
        if ($typeOfRental === "Apar"){
            return  0;
        }else{

            /** if it is a house, the database is checked to see how many kitchens it has */

            $db = getDB();
            $stmtNumberOFKitchens = $db->prepare('SELECT Kitchen FROM HOUSE WHERE RentalID = ?');
            $stmtNumberOFKitchens->execute([$this->RentalID]);

            $numberOfKitchens = $stmtNumberOFKitchens->fetch();

            return  $numberOfKitchens['Kitchen'];
        }
    }


    /**
     * Author: Hendrik Lendeckel
     * @return String with the information whether the house or apartment has a balcony or a terrace
     */

    public function getTypeOfFreeSeat() :String{

        /** getting the Type of the rental from the function way above*/
        $typeOfRental = substr($this->getRentalType(), 0, 4);
        $db = getDB();

        try {
            $typeOfFreeSeat = "";

            if ($typeOfRental === "Haus"){

                $stmtTerrace = $db->prepare('SELECT Terrace FROM HOUSE WHERE RentalID = ?');
                $stmtTerrace->execute([$this->RentalID]);
                $boolTerrace = $stmtTerrace->fetch();



                if ($boolTerrace['Terrace'] === 'Y'){
                    $typeOfFreeSeat = "Inklusive Terrasse";
                }else{
                    $typeOfFreeSeat = "Ohne Terrasse";
                }

            }elseif ($typeOfRental === "Apar"){

                $stmtBalcony = $db->prepare('SELECT Balcony FROM APPARTMENT WHERE RentalID = ?');
                $stmtBalcony->execute([$this->RentalID]);
                $boolBalcony = $stmtBalcony->fetch();

                if ($boolBalcony['Balcony'] === 'Y'){
                    $typeOfFreeSeat = "Inklusive Balkon";
                }else{
                    $typeOfFreeSeat = "Ohne Balkon";
                }

            }else{
                $typeOfFreeSeat = "No Rental Found";
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }


        return $typeOfFreeSeat;
    }


    /**
     * Author: Hendrik Lendeckel
     * This function creates a new rental using the database procedure p_NewRental.
     * This database procedure uses other sub-procedures.
     *
     * @param $maxVisitors
     * @param $bedroom
     * @param $bathroom
     * @param $sqrMeter
     * @param $status
     * @param $isApartment
     * @param $resortName
     * @param $balcony
     * @param $rnumber
     * @param $floor
     * @param $terrace
     * @param $kitchen
     * @param $street
     * @param $houseNumber
     * @param $zipCode
     * @param $city
     * @param $state
     * @return void
     */
    public static function newRental($maxVisitors,
                                     $bedroom,
                                     $bathroom,
                                     $sqrMeter,
                                     $status,
                                     $isApartment,
                                     $resortName,
                                     $balcony,
                                     $rnumber,
                                     $floor,
                                     $terrace,
                                     $kitchen,
                                     $street,
                                     $houseNumber,
                                     $zipCode,
                                     $city,
                                     $state) :Rental{

    echo $isApartment;

        try {
            $db = getDB();

            $stmtNewRental = $db->prepare('call p_NewRental(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $stmtNewRental->execute([   $maxVisitors,
                                        $bedroom,
                                        $bathroom,
                                        $sqrMeter,
                                        $status,
                                        $isApartment,

                                        $resortName,
                                        $balcony,
                                        $rnumber,
                                        $floor,
                                        $terrace,
                                        $kitchen,

                                        $street,
                                        $houseNumber,
                                        $zipCode,
                                        $city,
                                        $state]);

            $rentalID = $stmtNewRental->fetch()['inRentalID'];
            $stmtNewRental->closeCursor();
            return new Rental($rentalID);


        }catch (PDOException $e){
            echo $e->getMessage();
        }

    }

    public function getChildClass() : mixed {
        $db = getDB();

        $stmt1 = $db->prepare('SELECT RentalID FROM APPARTMENT WHERE RentalID = ?');
        $stmt2 = $db->prepare('SELECT RentalID FROM HOUSE WHERE RentalID = ?');
        $stmt1->execute([$this->RentalID]);
        $stmt2->execute([$this->RentalID]);
        $apartments = $stmt1->fetch();
        $houses = $stmt2->fetch();

        echo $this->RentalID;
        if ($apartments) {
            return Appartment::findByRentalId($this->RentalID);
        } else if ($houses) {
            return House::findByRentalId($this->RentalID);
        } else {//noAccountType settet
            return null;
        }
    }


    // Gibt das neueste Objekt in dem Resort zurück. In dem Array müssen alle verfügbaren werte drin stehen. auch
    // aus den Tabellen Appartment und house

    public static function getLastRentalInResort($resort) : Rental{
        $db = getDB();


        $stmtLastRental = $db->prepare("SELECT * FROM RENTAL WHERE ResortID = (SELECT fn_getResortID('?')) AND RentalID = (SELECT MAX(RentalID) FROM RENTAL WHERE ResortID = (SELECT fn_getResortID('?')))");
        $stmtLastRental->execute([$resort]);
        $rental = $stmtLastRental->fetch();

        return $rental;
    }


    //TODO Check correct Implementation:

    /**
     * Author: Max Schelenz
     * This function returns the last Renovation from STRUCCHANGE.
     * @return Renovation
     */
    public static function getLastRenovation() : Renovation{
        $db = getDB();

        $stmtLastRenovation = $db->prepare("SELECT * FROM STRUCCHANGE 
                                                            WHERE StrucchangeID = (SELECT MAX(StrucchangeID))
                                                            AND CraftServID IS NOT NULL");
        $stmtLastRenovation->execute();
        $renovation = $stmtLastRenovation->fetch();

        return $renovation;
    }


    // TODO stimmt noch nicht, mache ich -> Hendrik
    // getAddressFromRental
    /**
     * Author: Max Schelenz und Hendrik Lendeckel
     * This function returns the address from a given Rental with the help of the database function fn_GetRentalID.
     * @param $rentalID
     * @return Address
     */
    public static function getAddressFromRental($rentalID) : Address
    {
        $db = getDB();

        $stmtAddress = $db->prepare("SELECT * FROM ADDR
                                            JOIN RENTAL ON ADDR.AddrID = RENTAL.AddrID
                                            WHERE RentalID = ?");
        $stmtAddress->execute([$rentalID]);
        $address = $stmtAddress->fetch();
        $addressID = $address['AddrID'];
        echo $addressID;
        return new Address($addressID);
    }

}
