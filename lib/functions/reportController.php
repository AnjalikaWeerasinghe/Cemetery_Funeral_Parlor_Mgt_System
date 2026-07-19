<?php 
session_start();
include_once('main.php');

class ReportController extends MainController{

    public function generateReport($reportType, $month, $year){

        switch ($reportType) {

            case "monthly_income":
                $sql = "SELECT
                        SUM(CASE WHEN fs.service_type = 'Burial' THEN p.service_cost ELSE 0 END) AS burial_income,
                        SUM(CASE WHEN fs.service_type = 'Cremation' THEN p.service_cost ELSE 0 END) AS cremation_income,
                        SUM(COALESCE(p.memorial_cost,0)) AS memorial_income
                    FROM payment_table p
                    INNER JOIN funeral_service_table fs ON fs.funeral_service_id = p.funeral_service_table_funeral_service_id
                    WHERE MONTH(p.payment_date) = ?
                    AND YEAR(p.payment_date) = ? AND p.payment_status = 'Paid'";

                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("ii", $month, $year);
                $stmt->execute();

                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                $burialIncome    = $row['burial_income'] ?? 0;
                $cremationIncome = $row['cremation_income'] ?? 0;
                $memorialIncome  = $row['memorial_income'] ?? 0;

                $grandTotal = $burialIncome + $cremationIncome + $memorialIncome;

                $reportData = [
                    [
                        "service" => "Burial",
                        "total_income" => $burialIncome
                    ],
                    [
                        "service" => "Cremation",
                        "total_income" => $cremationIncome
                    ],
                    [
                        "service" => "Memorial",
                        "total_income" => $memorialIncome
                    ]
                ];

                $fromDate = date("Y-m-01", strtotime("$year-$month-01"));
                $toDate   = date("Y-m-t", strtotime("$year-$month-01"));

                require_once(__DIR__ . "/../views/report/monthly_income_report.php");
                break;

            case "monthly_expense":
                require_once(__DIR__ . "/../views/report/monthly_expense_report.php");
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

    public function getMonthlyIncomeReport($month, $year){

        $sql = "SELECT
                    fs.service_type,
                    SUM(p.total_payment) AS total_income
                FROM funeral_service_table fs
                INNER JOIN payment_table p
                ON fs.funeral_service_id = p.funeral_service_table_funeral_service_id
                WHERE MONTH(p.payment_date)=?
                AND YEAR(p.payment_date)=?
                AND p.payment_status='Paid'
                GROUP BY fs.service_type";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $month, $year);
        $stmt->execute();

        $result = $stmt->get_result();

        $data = [];
        $grandTotal = 0;

        while ($row = $result->fetch_assoc()) {
            $grandTotal += $row['total_income'];
            $data[] = $row;
        }

        echo json_encode([
            "from" => date("Y-m-01", strtotime("$year-$month-01")),
            "to" => date("Y-m-t", strtotime("$year-$month-01")),
            "grandTotal" => $grandTotal,
            "data" => $data
        ]);
    }
}

?>