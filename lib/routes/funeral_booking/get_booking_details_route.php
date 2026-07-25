<?php
require_once "../../functions/burialPlotController.php";

if (isset($_POST['funeral_service_id'])) {
    $funeralServiceId = $_POST['funeral_service_id'];

    $controller = new BurialPlotController();

    echo $controller->getBookingDetails($funeralServiceId);

} else {
    echo "<div class='alert alert-danger'>Invalid Request.</div>";
}

?>