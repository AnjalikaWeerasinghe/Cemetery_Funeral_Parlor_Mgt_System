<?php 
session_start();
include_once('main.php');

class ReportController extends MainController{

    public function generateReport()
{
    if (!isset($_POST['action']) || $_POST['action'] != "generateReport") {
        return;
    }

    $reportType = $_POST['reportType'];
    $month      = $_POST['month'];
    $year       = $_POST['year'];

    switch ($reportType) {

        case "monthly_cremation":
            require_once(__DIR__ . "/../views/report/monthly_cremation_report.php");
            break;

        case "burial":
            require_once(__DIR__ . "/../views/report/burial_report.php");
            break;

        case "revenue":
            require_once(__DIR__ . "/../views/report/revenue_report.php");
            break;

        case "member":
            require_once(__DIR__ . "/../views/report/member_report.php");
            break;

        default:
            echo "<div class='alert alert-danger'>Invalid Report Type.</div>";
            break;
    }
}
}

?>