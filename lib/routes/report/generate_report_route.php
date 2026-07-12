<?php 
include_once('../../functions/reportController.php');

$report = new ReportController();

if (isset($_POST['action']) && $_POST['action'] == 'generateReport') {

    $reportType = $_POST['reportType'];
    $month      = $_POST['month'];
    $year       = $_POST['year'];

    echo $report->generateReport($reportType, $month, $year);
}

?>