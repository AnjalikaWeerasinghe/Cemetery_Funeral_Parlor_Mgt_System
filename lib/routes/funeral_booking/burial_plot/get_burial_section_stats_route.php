<?php 
require_once("../../../functions/burialPlotController.php");

$controller = new BurialPlotController();

$controller->getSectionStats(
    $_POST['section_id']
);

?>