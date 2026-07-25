<?php 
require_once "../../functions/burialPlotController.php";

$controller = new BurialPlotController();

if (!isset($_POST['plot_id']) || !isset($_POST['funeral_service_id'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing required data."
    ]);
    exit;
}

$plotId = (int)$_POST['plot_id'];
$funeralServiceId = (int)$_POST['funeral_service_id'];

$result = $controller->allocatePlot($plotId, $funeralServiceId);

echo json_encode($result);
exit;

?>