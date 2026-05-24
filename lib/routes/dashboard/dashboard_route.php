<?php
include_once('../../functions/dashboardController.php');

$dashboard = new DashboardController($conn);

if(isset($_GET['action'])) {

    switch($_GET['action']) {

        case 'upcoming_cremations':
            $dashboard->get_Upcoming_Cremations();
            break;

        case 'upcoming_burials':
            $dashboard->get_Upcoming_Burials();
            break;

        default:
            echo json_encode([
                "status" => "error",
                "message" => "Invalid action"
            ]);
    }

}

?>