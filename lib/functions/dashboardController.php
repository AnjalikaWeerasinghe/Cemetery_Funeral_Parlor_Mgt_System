<?php
session_start();
include_once('main.php');

class DashboardController extends MainController{

    public function get_Upcoming_Cremations(){

    $sql = "SELECT d.full_name AS deceased_name, c.cremation_date, sch.start_time, sch.end_time, fs.booking_status
            FROM cremation_table c
            JOIN funeral_service_table fs ON c.cremation_id = fs.funeral_service_table_funeral_service_id
            JOIN deceased_table d ON fs.deceased_table_deceased_id = d.deceased_id
            JOIN schedule_table sch ON c.cremation_id = sch.schedule_slots_table_slot_id
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

    // public function get_Upcoming_Burials(){

    //     $sql = "SELECT d.full_name AS deceased_name, fs.date_time, fs.status
    //             FROM funeral_service_table fs
    //             JOIN deceased_table d ON fs.deceased_table_deceased_id = d.deceased_id
    //             WHERE fs.service_type = 'Burial' AND fs.date_time >= NOW()
    //             ORDER BY fs.date_time ASC";

    //     $result = $this->conn->query($sql);
    //     $burials = [];

    //     if ($result && $result->num_rows > 0) {
    //         while($rec = $result->fetch_assoc()) {
    //             $burials[] = $rec;
    //         }
    //     }

    //     return $burials;
    // }
}

?>