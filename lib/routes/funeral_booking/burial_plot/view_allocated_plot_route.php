<?php
require_once("../../../functions/burialPlotController.php");

$controller = new BurialPlotController();

$controller->viewAllocatedPlot($_POST['plot_id']);

?>