<?php
session_start();
include_once('main.php');

class BurialPlotController extends MainController {

    public function addSection($section_name, $total_plots){

        $sql = "INSERT INTO burial_plot_section_table 
                (section_name, total_plots, available_plots, created_at)
                VALUES (?, ?, ?, NOW())";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            die($this->conn->error);
        }

        $stmt->bind_param("sii", 
            $section_name, $total_plots, $total_plots
        );

        $stmt->execute();

        $sectionId = $this->conn->insert_id;

        $plotsPerRow = 7;

        for($i=1; $i <= $total_plots; $i++) {
            $plotNumber = 'P'.str_pad($i, 3, '0', STR_PAD_LEFT);
            $row = ceil($i / $plotsPerRow);
            $block = (($i-1) % $plotsPerRow) + 1;


            $rowNumber = "Row ".$row;
            $blockNumber = "Block ".$block;

            $status = "Available";

            $plotSql = "INSERT INTO plot_table
                (plot_number, row_number, block_number, burial_plot_section_table_cem_section_id, plot_status)
                VALUES (?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($plotSql);

            if(!$stmt){
                die("Plot Insert Error: " . $this->conn->error);
            }

            if(!$stmt){
                die($this->conn->error);
            }

            $stmt->bind_param("sssis",
                $plotNumber, $rowNumber, $blockNumber, $sectionId, $status
            );

            $stmt->execute();
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
            <div class="plot-card '.$statusClass.'" data-id="'.$plot['plot_id'].'" data-status="'.$plot['plot_status'].'">
                <div class="plot-header">
                    <span class="plot-number">'.$plot['plot_number'].'</span>
                </div>

                <div class="plot-body">
                    <div class="plot-location">
                        <small>'.$plot['row_number'].' • '.$plot['block_number'].'</small>
                    </div>

                    <div class="plot-type">
                        '.$plot['plot_type'].'
                    </div>

                    <div class="plot-status">
                        '.$plot['plot_status'].'
                    </div>
                </div>
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

        $sql = "SELECT 
                s.section_name,
                COUNT(p.plot_id) AS total_plots,
                SUM(CASE WHEN p.plot_status='Available' THEN 1 ELSE 0 END) AS available_plots,
                SUM(CASE WHEN p.plot_status='Occupied' THEN 1 ELSE 0 END) AS occupied_plots
            FROM burial_plot_section_table s
            INNER JOIN plot_table p 
            ON s.cem_section_id = p.burial_plot_section_table_cem_section_id
            WHERE s.cem_section_id = ?
            GROUP BY s.cem_section_id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i",$sectionId);

        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        echo json_encode([
            'section_name' => $row['section_name'],
            'total'        => $row['total_plots'],
            'available'    => $row['available_plots'],
            'occupied'     => $row['occupied_plots']
        ]);
    }

    public function getDashboardStats() {

        $sql = "SELECT
                    COUNT(DISTINCT s.cem_section_id) AS total_sections,
                    COUNT(p.plot_id) AS total_plots,
                    SUM(CASE WHEN p.plot_status='Available' THEN 1 ELSE 0 END) AS available_plots,
                    SUM(CASE WHEN p.plot_status='Occupied' THEN 1 ELSE 0 END) AS occupied_plots
                FROM burial_plot_section_table s
                LEFT JOIN plot_table p
                ON s.cem_section_id = p.burial_plot_section_table_cem_section_id";


        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();


        echo json_encode([
            'sections'    => $row['total_sections'],
            'total_plots' => $row['total_plots'],
            'available'   => $row['available_plots'],
            'occupied'    => $row['occupied_plots']
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

    public function loadBurialSections() {

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

    public function getBookingDetails($funeralServiceId) {

        $sql = "SELECT fs.booking_code, d.full_name AS deceased_name, a.applicant_name, br.burial_date, br.grave_type, br.area_type, fs.booking_status
            FROM funeral_service_table fs
            INNER JOIN burial_request_table br ON fs.funeral_service_id = br.funeral_service_table_funeral_service_id
            INNER JOIN deceased_table d ON fs.deceased_table_deceased_id = d.deceased_id
            INNER JOIN applicant_table a ON fs.applicant_table_applicant_id = a.applicant_id
            WHERE fs.funeral_service_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $funeralServiceId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {

            return json_encode([
                "booking_code"   => $row['booking_code'],
                "deceased_name"  => $row['deceased_name'],
                "applicant_name" => $row['applicant_name'],
                "burial_date"    => $row['burial_date'],
                "grave_type"     => $row['grave_type'],
                "area_type"      => $row['area_type'],
                "booking_status" => $row['booking_status']
            ]);

        }

        return json_encode([
            "status" => "error",
            "message" => "Booking not found."
        ]);
            
    }

    public function getAvailablePlots($sectionId) {

        $sql = "SELECT p.plot_id, p.plot_number, p.plot_type, p.plot_status, s.section_name
            FROM plot_table p
            INNER JOIN burial_plot_section_table s ON p.burial_plot_section_table_cem_section_id = s.cem_section_id
            WHERE burial_plot_section_table_cem_section_id = ?
            ORDER BY p.plot_number ASC";

        $stmt  = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare Error: " . $this->conn->error);
        }

        $stmt->bind_param("i", $sectionId);

        if (!$stmt->execute()) {
            die("Execute Error: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return "<div class='col-12 text-center text-muted'>No burial plots available.</div>";
        }

        $output = "";

        while ($row = $result->fetch_assoc()) {

            $class = "";

            switch ($row['plot_status']) {
                case "Available":
                    $class = "available";
                    break;

                case "Reserved":
                    $class = "reserved";
                    break;

                case "Occupied":
                    $class = "occupied";
                    break;

                default:
                    $class = "";
            }

            $output .= '
                <div class="plot-card '.$class.'" data-id="'.$row['plot_id'].'" data-plot="'.$row['plot_number'].'" data-section="'.$row['section_name'].'">
                    <div class="plot-number">
                        '.$row['plot_number'].'
                    </div>

                    <div class="plot-info">
                        <small>'.$row['section_name'].'</small>
                    </div>

                    <div class="plot-type">
                        '.$row['plot_type'].'
                    </div>

                    <div class="plot-status">
                        '.$row['plot_status'].'
                    </div>
                </div>';
        }

        return $output;
    }

    public function getBurialSections() {

        $sql = "SELECT cem_section_id, section_name
                FROM burial_plot_section_table
                ORDER BY section_name ASC";

        $result = $this->conn->query($sql);

        if (!$result) {
            return "<li class='nav-item text-danger'>".$this->conn->error."</li>";
        }

        if ($result->num_rows == 0) {
            return "<li class='nav-item text-muted'>No Sections Found</li>";
        }

        $output = "";

        while ($row = $result->fetch_assoc()) {

            $output .= '
                <li class="nav-item">
                    <button type="button" class="nav-link section-tab" data-id="'.$row['cem_section_id'].'">
                        '.$row['section_name'].'
                    </button>
                </li>';
        }

        return $output;
    }

    public function allocatePlot($plotId, $funeralServiceId){

        $this->conn->begin_transaction();

        try {

            $sql1 = "UPDATE plot_table
                    SET plot_status='Occupied'
                    WHERE plot_id=?";

            $stmt1 = $this->conn->prepare($sql1);

            if(!$stmt1){
                throw new Exception("Plot Update Error: ".$this->conn->error);
            }

            $stmt1->bind_param("i", $plotId);
            $stmt1->execute();

            $sql2 = "UPDATE burial_request_table
                    SET plot_table_plot_id=?
                    WHERE funeral_service_table_funeral_service_id=?";

            $stmt2 = $this->conn->prepare($sql2);

            if(!$stmt2){
                throw new Exception("Burial Request Update Error: ".$this->conn->error);
            }

            $stmt2->bind_param("ii", $plotId, $funeralServiceId);
            $stmt2->execute();

            $this->conn->commit();

            return [
                "status"=>"success",
                "message"=>"Plot allocated successfully"
            ];

        } catch(Exception $e){

            $this->conn->rollback();

            return [
                "status"=>"error",
                "message"=>$e->getMessage()
            ];
        }
    }

    public function getPlotOccupier($plotId) {

        $sql = "SELECT p.plot_number, br.burial_date, d.full_name, d.nic, d.gender, d.date_of_birth
                FROM plot_table p
                INNER JOIN burial_request_table br ON p.plot_id = br.plot_table_plot_id
                INNER JOIN funeral_service_table fs ON br.funeral_service_table_funeral_service_id = fs.funeral_service_id
                INNER JOIN deceased_table d ON fs.deceased_table_deceased_id = d.deceased_id
                WHERE p.plot_id=?";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            return json_encode([
                "status"=>"error",
                "message"=>$this->conn->error
            ]);
        }

        $stmt->bind_param("i",$plotId);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            return json_encode([
                "status"=>"success",
                "data"=>$result->fetch_assoc()
            ]);
        }

        return json_encode([
            "status"=>"error",
            "message"=>"No occupier found"
        ]);

    }

    public function viewAllocatedPlot($plotId){

        $sql = "SELECT p.plot_number, p.row_number, p.block_number, p.plot_type, p.plot_status, s.section_name
            FROM plot_table p
            INNER JOIN burial_plot_section_table s ON p.burial_plot_section_table_cem_section_id = s.cem_section_id
            WHERE p.plot_id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i",$plotId);

        $stmt->execute();

        $result = $stmt->get_result();

        if($row = $result->fetch_assoc()){
            echo '
            <div class="card">
                <div class="card-body">
                    <h4>'.$row['plot_number'].'</h4>

                    <p>
                        <b>Section:</b> '.$row['section_name'].'
                    </p>

                    <p>
                        <b>Location:</b> 
                        '.$row['row_number'].' - '.$row['block_number'].'
                    </p>

                    <p>
                        <b>Type:</b> '.$row['plot_type'].'
                    </p>

                    <p>
                        <b>Status:</b> '.$row['plot_status'].'
                    </p>
                </div>
            </div>';
        }

    }

}

?>
