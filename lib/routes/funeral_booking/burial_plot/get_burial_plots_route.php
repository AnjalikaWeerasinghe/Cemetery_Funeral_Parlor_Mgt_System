<?php 
require_once("../../../functions/burialPlotController.php");

$controller = new BurialPlotController();

if(isset($_POST['section_id'])){

    $section_id = $_POST['section_id'];

    $controller->loadPlots($section_id);

}else{

    echo "Section ID not received";

}

?>