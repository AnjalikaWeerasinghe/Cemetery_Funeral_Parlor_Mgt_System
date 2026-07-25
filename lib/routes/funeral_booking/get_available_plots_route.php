<?php 
require_once "../../functions/burialPlotController.php";

$sectionId = $_POST['section_id'];

$controller = new BurialPlotController();

echo $controller->getAvailablePlots($sectionId);

?>