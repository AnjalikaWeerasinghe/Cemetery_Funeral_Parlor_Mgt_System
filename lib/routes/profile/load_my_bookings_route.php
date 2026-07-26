<?php
require_once("../../functions/bookingController.php");

if(!isset($_SESSION['user_id'])){

    echo "
        <tr>
            <td colspan='5' class='text-center'>
                Please login first
            </td>
        </tr>";

    exit;
}

$user_id = $_SESSION['user_id'];

$bookingController = new BookingController();

echo $bookingController->loadMyBookings($user_id);

?>