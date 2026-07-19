<?php
include_once('main.php');

class DeceasedController extends MainController{

    // Load summerized deceased data to the deceased details table 
    public function view_Deceased_Data($search = "", $religion = "", $service_type = ""){

        $sqlView = "SELECT d.deceased_photo, d.title, d.full_name AS deceased_name, d.nic, d.gender, d.religion,
            doc.date_of_death, fs.service_type, fs.booking_code
            FROM funeral_service_table fs
            JOIN deceased_table d ON fs.deceased_table_deceased_id = d.deceased_id
            JOIN document_table doc ON fs.document_table_document_set_id = doc.document_id
            WHERE 1 = 1";

        $params = [];
        $types = "";

        // Search by Name and NIC
        if(!empty($search)) {
            $sqlView .= " AND (d.full_name LIKE ? OR d.nic LIKE ?)";

            $keyword = "%$search%";

            $params[] = $keyword;
            $params[] = $keyword;

            $types .= "ss";
        } 

        // Filter deceased by religion
        if(!empty($religion)) {
            $sqlView .= " AND d.religion = ?";
            
            $params[] = $religion;

            $types .= "s";
        }

        // Filter deceased by final disposition
        if(!empty($service_type)) {
            $sqlView .= " AND fs.service_type = ?";

            $params[] = $service_type;

            $types .= "s";
        }

        $sqlView .= " ORDER BY fs.booking_created_at DESC";
        
        $stmt = $this->conn->prepare($sqlView);

        if(!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();

        $resultView  = $stmt->get_result(); 

        if ($resultView  && $resultView ->num_rows > 0) {

            while($rec = $resultView ->fetch_assoc()) {

                echo "<tr>";
                

                $image = !empty($rec['deceased_photo'])
                    ? "../" . $rec['deceased_photo']
                    : "../uploads/default_user_image.png";

                echo "<td><img src='{$image}' class='rounded-circle' width='55' height='55' style='object-fit:cover;'></td>"; // Placeholder for photo
                echo "<td>" . $rec['title'] . " " . $rec['deceased_name'] . "</td>";
                echo "<td>" . $rec['nic'] . "</td>";
                echo "<td>" . $rec['gender'] . "</td>";
                echo "<td>" . $rec['date_of_death'] . "</td>";
                echo "<td>" . $rec['service_type'] . "</td>";
                echo "<td>" . $rec['religion'] . "</td>";

                echo "<td>
                        <button class='btn btn-outline-info btn-sm view' data-id='{$rec['booking_code']}' data-bs-toggle='tooltip' title='View Deceased Details'>
                            <i class='fa-solid fa-eye'></i>
                        </button>

                        <button class='btn btn-outline-primary btn-sm edit' data-id='".$rec['booking_code']."' data-bs-toggle='tooltip' title='Edit Deceased Details'>
                            <i class='fa-solid fa-pen'></i>
                        </button>
                      </td>";
                echo "</tr>";
            }

        } 
        
    }

    // Load detailed/compeleted deceased data view by using the booking code
    public function getDeceasedDetails_By_BookingCode($booking_code){

        $sql = "SELECT fs.booking_code,
                d.title, d.full_name, d.deceased_photo, d.religion, d.nic, d.deceased_address, d.gender, d.date_of_birth, d.deceased_gn_division, d.municipal_council,
                a.applicant_name, a.applicant_nic, a.applicant_nic_front, a.applicant_nic_back, a.relationship_to_deceased, a.contact_number, a.email, a.applicant_gn_division, a.applicant_address, 
                doc.death_certificate_number, doc.registrar_name, doc.date_of_death, doc.cause_of_death, doc.coroner_name, doc.coroner_decision, doc.cremation_permission,
                doc.death_certificate, doc.coroner_certificate, doc.family_consent_letter,
                c.cremation_date, c.area_type AS cremation_area_type, c.notes, 
                ms.memorial_name, ms.memorial_message, ms.memorial_icon, ms.font_style, ms.tablet_theme, ms.memorial_image,
                fs.service_type,
                br.burial_date, br.area_type AS burial_area_type
                FROM funeral_service_table fs
                JOIN deceased_table d ON fs.deceased_table_deceased_id = d.deceased_id
                JOIN applicant_table a ON fs.applicant_table_applicant_id = a.applicant_id
                JOIN document_table doc ON fs.document_table_document_set_id = doc.document_id
                LEFT JOIN cremation_table c ON fs.funeral_service_id = c.funeral_service_table_funeral_service_id
                LEFT JOIN memorial_service_table ms ON fs.funeral_service_id = ms.funeral_service_table_funeral_service_id
                LEFT JOIN burial_request_table br ON fs.funeral_service_id = br.funeral_service_table_funeral_service_id
                WHERE fs.booking_code = ?";

        $stmt = $this->conn->prepare($sql);
        if(!$stmt){
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->bind_param("s", $booking_code);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    } 

    public function getDeceasedDashboardStats(){

        $sql = "SELECT COUNT(*) AS total_deceased,
            SUM(CASE WHEN service_type = 'Burial' THEN 1 ELSE 0 END)
            AS total_burials,
            SUM(CASE WHEN service_type = 'Cremation' THEN 1 ELSE 0 END)
            AS total_cremations
            FROM funeral_service_table";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return [
            "total_deceased"   => 0,
            "total_burials"  => 0,
            "total_cremations"=> 0
        ];
    }

}

?>