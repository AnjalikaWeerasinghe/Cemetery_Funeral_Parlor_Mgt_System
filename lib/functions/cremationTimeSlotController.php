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

    public function addSlot($day, $start, $end) {

        $check = $this->conn->query("
            SELECT * FROM schedule_slots_table
            WHERE day_of_the_week='$day'
            AND (
                ('$start' BETWEEN start_time AND end_time)
                OR ('$end' BETWEEN start_time AND end_time)
                OR (start_time BETWEEN '$start' AND '$end')
            )
        ");

        if($check->num_rows > 0){
            return "Time slot overlaps!";
        }

        $this->conn->query("
            INSERT INTO schedule_slots_table (day_of_the_week, start_time, end_time)
            VALUES ('$day', '$start', '$end')
        ");

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