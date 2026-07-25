<?php
require_once("../../../functions/burialPlotController.php");

$burialPlotController = new BurialPlotController();

if(isset($_POST['plot_id'])){
    $plotId = $_POST['plot_id'];
    $response = $burialPlotController->getPlotOccupier($plotId);

    echo $response;
}
else{
    echo json_encode([
        "status"=>"error",
        "message"=>"Plot ID missing"
    ]);
}

?>