<?php

class Booking extends Model {
    public function __construct($bookingId)
    {
        parent::__construct('BOOKING', 'BookingID', $bookingId);
    }

    public static function delete($GuestID) : bool {

        try {
            $db = getDB();
            $db->beginTransaction();

            $stmt = $db->prepare('DELETE FROM BOOKING WHERE GuestID = ?');
            $stmt->execute([$GuestID]);

            $db->commit();

            return true;

        }catch (PDOException $e) {
            echo $e->getMessage();
        }

        return false;
    }

}
