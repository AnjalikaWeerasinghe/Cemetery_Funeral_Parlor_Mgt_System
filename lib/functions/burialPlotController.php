<?php
session_start();
include_once('main.php');

class BurialPlotController extends MainController {

    public function addSection($section_name, $total_plots){

        $sql = "INSERT INTO burial_plot_section_table (section_name, total_plots, available_plots, created_at)
                VALUES ('$section_name','$total_plots','$total_plots',NOW())";

        $this->conn->query($sql);

        $sectionId = $this->conn->insert_id;

        for($i=1; $i <= $total_plots; $i++)
        {
            $plotNumber = 'P'.str_pad($i, 3, '0', STR_PAD_LEFT);

            $plotSql = "INSERT INTO plot_table (plot_number, burial_plot_section_table_cem_section_id, plot_status)
                        VALUES ('$plotNumber', '$sectionId', 'Available')";

            $this->conn->query($plotSql);
        }

        echo "success";
    }

    public function loadSections(){

        $sql = "SELECT *
                FROM burial_plot_section_table
                ORDER BY cem_section_id DESC";

        $result = $this->conn->query($sql);

        while($section = $result->fetch_assoc()){

            echo '
            <li class="nav-item me-2">
                <button class="nav-link section-tab" data-id="'.$section['cem_section_id'].'">
                    '.$section['section_name'].'
                </button>
            </li>';
        }
    }

    public function loadPlots($sectionId){

        $result = $this->getPlotsBySection($sectionId);

        while($plot = $result->fetch_assoc())
        {
            $statusClass = '';

            if($plot['plot_status'] == 'Available'){
                $statusClass = 'plot-available';
            }
            elseif($plot['plot_status'] == 'Occupied'){
                $statusClass = 'plot-occupied';
            }
            else{
                $statusClass = 'plot-reserved';
            }

            echo '
            <div class="plot-card '.$statusClass.'" data-id="'.$plot['plot_id'].'">
                <h6>'.$plot['plot_number'].'</h6>
                <span class="badge bg-success">'.$plot['plot_status'].'</span>
            </div>';
        }
    }

    public function getPlotsBySection($sectionId) {

        $sql = "SELECT * FROM plot_table 
                WHERE burial_plot_section_table_cem_section_id = '$sectionId'
                ORDER BY plot_number ASC";

        return $this->conn->query($sql);
    }

    public function getSectionStats($sectionId){

        $sql = "SELECT section_name, total_plots, available_plots
                FROM burial_plot_section_table
                WHERE cem_section_id = '$sectionId'";

        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        $occupied = $row['total_plots'] - $row['available_plots'];

        echo json_encode([
            'section_name' => $row['section_name'],
            'total'        => $row['total_plots'],
            'available'    => $row['available_plots'],
            'occupied'     => $occupied
        ]);
    }

    public function getDashboardStats(){

        $sql = "SELECT COUNT(*) AS total_sections,
                SUM(total_plots) AS total_plots,
                SUM(available_plots) AS available_plots
                FROM burial_plot_section_table";

        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();

        $totalSections = $row['total_sections'] ?? 0;
        $totalPlots = $row['total_plots'] ?? 0;
        $availablePlots = $row['available_plots'] ?? 0;
        $occupiedPlots = $totalPlots - $availablePlots;

        echo json_encode([
            'sections'    => $totalSections,
            'total_plots' => $totalPlots,
            'available'   => $availablePlots,
            'occupied'    => $occupiedPlots
        ]);
    }

    public function deletePlot($id) {
        $this->conn->query("DELETE FROM plot_table WHERE cem_section_id=$id");
    }

    public function toggleReserved($id) {

        $plot = $this->conn->query("SELECT is_reserved FROM plot_table WHERE cem_section_id=$id")->fetch_assoc();

        if(!$plot){
            return "Plot not found.";
        }

        $newStatus = $plot['is_reserved'] ? 0 : 1;

        $this->conn->query("UPDATE plot_table SET is_reserved=$newStatus WHERE cem_section_id=$id");
    }

    public function loadBurialSections(){

        $sql = "SELECT cem_section_id, section_name
                FROM burial_plot_section_table
                ORDER BY section_name ASC";

        $result = $this->conn->query($sql);

        $sections = [];

        while($row = $result->fetch_assoc()){
            $sections[] = $row;
        }

        echo json_encode($sections);
    }

}

?>
