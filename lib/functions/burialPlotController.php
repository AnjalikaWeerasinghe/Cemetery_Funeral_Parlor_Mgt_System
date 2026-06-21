<?php
session_start();
include_once('main.php');

class BurialPlotController extends MainController {

    public function getPlotsBySection($section) {

        $sql = "SELECT * FROM burial_plots_table 
                WHERE section = '$section'
                ORDER BY plot_number ASC";

        return $this->conn->query($sql);
    }

    public function deletePlot($id) {
        $this->conn->query("DELETE FROM burial_plots_table WHERE plot_id=$id");
    }

    public function toggleReserved($id) {

        $plot = $this->conn->query("SELECT is_reserved FROM burial_plots_table WHERE plot_id=$id")->fetch_assoc();

        if(!$plot){
            return "Plot not found.";
        }

        $newStatus = $plot['is_reserved'] ? 0 : 1;

        $this->conn->query("UPDATE burial_plots_table SET is_reserved=$newStatus WHERE plot_id=$id");
    }
}

?>