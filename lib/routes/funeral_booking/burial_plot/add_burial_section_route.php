<?php
require_once("../../../functions/burialPlotController.php");

$controller = new BurialPlotController();

$controller->addSection(
    $_POST['section_name'],
    $_POST['total_plots']
);

?>