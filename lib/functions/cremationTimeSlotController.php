<?php 
session_start();
include_once('main.php');

class CremationTimeSlotController extends MainController {

    public function getSlotsByDay($day) {

        $sql = "SELECT * FROM schedule_slots_table 
                WHERE day_of_the_week = '$day'
                ORDER BY start_time ASC";

        return $this->conn->query($sql);
    }

    public function addSlot($day, $slottype, $start, $end) {

        if(empty($day) || empty($slottype) || empty($start) || empty($end)) {
            return "All fields are required.";
        }

        $start = date("H:i:s", strtotime($start));
        $end   = date("H:i:s", strtotime($end));

        if(strtotime($start) >= strtotime($end)){
            return "End time must be after start time!";
        }

        $check = $this->conn->query("
            SELECT * FROM schedule_slots_table WHERE day_of_the_week='$day'
            AND (
                ('$start' BETWEEN start_time AND end_time)
                OR ('$end' BETWEEN start_time AND end_time)
                OR (start_time BETWEEN '$start' AND '$end')
            )
        ");

        if(!$check){
            return "Check Error: " . $this->conn->error;
        }

        if($check->num_rows > 0){
            return "Time slot overlaps!";
        }

        $insert = $this->conn->query("
            INSERT INTO schedule_slots_table (day_of_the_week, slot_type, start_time, end_time, is_active)
            VALUES ('$day', '$slottype', '$start', '$end', 1)
        ");

        if(!$insert){
            return "Insert Error: " . $this->conn->error;
        }

        return "Slot added successfully";
    }

    public function deleteSlot($id) {

        $this->conn->query("DELETE FROM schedule_slots_table WHERE slot_id=$id");

        return "Slot deleted";
    }

    public function toggleSlot($id) {

        $this->conn->query("
            UPDATE schedule_slots_table 
            SET is_active = NOT is_active 
            WHERE slot_id=$id
        ");

        return "Slot status updated";
    }
}

?>