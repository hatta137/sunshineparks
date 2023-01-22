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

            $stmtBookingID = $db->prepare('SELECT BookingID FROM BOOKING WHERE GuestID = ?');
            $stmtBookingID->execute([$GuestID]);
            $row = $stmtBookingID->fetch();

            $stmtDetail = $db->prepare('DELETE FROM BOOKINGDETAIL WHERE BookingID = ?');
            $stmtDetail->execute([$row['BookingID']]);

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
