<?php
include_once('../../functions/dashboardController.php');
header('Content-Type: application/json');

$dashboard = new DashboardController();

if(isset($_GET['action'])) {

    switch($_GET['action']) {

        case 'upcoming_cremations':
            echo json_encode($dashboard->get_Upcoming_Cremations());
            break;

        case 'upcoming_burials':
            echo json_encode($dashboard->get_Upcoming_Burials());
            break;

        case "monthly_chart":
            echo json_encode($dashboard->getMonthlyBurialCremationStats());
            break;

        default:
            echo json_encode([
                "status" => "error",
                "message" => "Invalid action"
            ]);
    }

}

?>