<?php 
require_once("../../../functions/burialPlotController.php");

$controller = new BurialPlotController();

$controller->loadPlots(
    $_POST['section_id']
);

?>