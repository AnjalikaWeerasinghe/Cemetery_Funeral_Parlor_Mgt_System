<?php
session_start();
include_once('main.php');

class DashboardController extends MainController{

    public function get_Upcoming_Cremations(){

        $sql = "SELECT d.full_name AS deceased_name, c.cremation_date, sch.start_time, sch.end_time, fs.booking_status, fs.booking_code
                FROM cremation_table c
                INNER JOIN funeral_service_table fs ON c.funeral_service_table_funeral_service_id = fs.funeral_service_id
                INNER JOIN deceased_table d ON fs.deceased_table_deceased_id = d.deceased_id
                INNER JOIN schedule_slots_table sch ON c.schedule_slots_table_slot_id = sch.slot_id
                WHERE c.cremation_date >= CURDATE()
                ORDER BY c.cremation_date ASC, sch.start_time ASC";

        $result = $this->conn->query($sql);

        $cremations = [];

        if ($result && $result->num_rows > 0) {

            while($rec = $result->fetch_assoc()) {

                $cremations[] = $rec;

            }

        }

        return $cremations;
    }

    public function get_Upcoming_Burials(){

        $sql = "SELECT d.full_name AS deceased_name, b.burial_date, fs.booking_status, fs.booking_code
                FROM burial_request_table b
                INNER JOIN funeral_service_table fs ON b.funeral_service_table_funeral_service_id = fs.funeral_service_id
                INNER JOIN deceased_table d ON fs.deceased_table_deceased_id = d.deceased_id
                WHERE b.burial_date >= CURDATE()
                ORDER BY b.burial_date ASC";

        $result = $this->conn->query($sql);

        $burials = [];

        if ($result && $result->num_rows > 0) {

            while($rec = $result->fetch_assoc()) {

                $burials[] = $rec;

            }

        }

        return $burials;
    }

    public function getDashboardCounts(){

        $sql = "SELECT
                    (SELECT COUNT(*) FROM deceased_table) AS total_records,
                    (SELECT COUNT(*) FROM funeral_service_table WHERE service_type = 'Burial') AS total_burials,
                    (SELECT COUNT(*) FROM funeral_service_table WHERE service_type = 'Cremation') AS total_cremations
                ";

        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }

    public function getMonthlyBurialCremationStats(){

        $sql = "SELECT 
                    DATE_FORMAT(MIN(booking_created_at),'%b') AS month,
                    SUM(CASE WHEN service_type='Burial' THEN 1 ELSE 0 END) AS burials,
                    SUM(CASE WHEN service_type='Cremation' THEN 1 ELSE 0 END) AS cremations
                FROM funeral_service_table
                WHERE YEAR(booking_created_at)=YEAR(CURDATE())
                GROUP BY YEAR(booking_created_at), MONTH(booking_created_at)
                ORDER BY MONTH(booking_created_at)";


        $result = $this->conn->query($sql);

        if (!$result) {
            die("SQL Error: " . $this->conn->error);
        }

        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }

}

?>
