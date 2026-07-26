<?php 
require_once "../../functions/burialPlotController.php";

$sectionId = $_POST['section_id'] ?? null;

if(!$sectionId){
    echo "No section selected";
    exit;
}

$controller = new BurialPlotController();

echo $controller->getAvailablePlots($sectionId);

?>