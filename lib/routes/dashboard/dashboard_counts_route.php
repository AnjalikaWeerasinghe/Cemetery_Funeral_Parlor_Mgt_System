<?php

include_once('../../functions/dashboardController.php');

$controller = new DashboardController();

echo json_encode(
    $controller->getDashboardCounts()
);

?>