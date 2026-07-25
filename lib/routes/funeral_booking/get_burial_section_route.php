<?php 
require_once "../../functions/burialPlotController.php";

$controller = new BurialPlotController();

echo $controller->getBurialSections();

?>