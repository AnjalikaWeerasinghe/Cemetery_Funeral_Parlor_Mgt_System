<?php
include_once('../../functions/dashboardController.php');
header('Content-Type: application/json');

$dashboard = new DashboardController();

if(isset($_GET['action'])) {

    switch($_GET['action']) {

        case 'upcoming_cremations':
            // $data = $dashboard->get_Upcoming_Cremations();
            // print_r($data);
            // exit;
            echo json_encode($dashboard->get_Upcoming_Cremations());
            break;

        default:
            echo json_encode([
                "status" => "error",
                "message" => "Invalid action"
            ]);
    }

}

?>