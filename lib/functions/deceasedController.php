<?php
include_once('main.php');

class DeceasedController extends MainController{

    // Load summerized deceased data to the deceased details table 
    public function view_Deceased_Data(){

        $sql = "SELECT d.deceased_photo, d.title, d.full_name AS deceased_name, d.nic, d.gender, doc.date_of_death, fs.service_type, d.religion, fs.booking_code
                FROM funeral_service_table fs
                JOIN deceased_table d ON fs.deceased_table_deceased_id = d.deceased_id
                JOIN document_table doc ON fs.document_table_document_set_id = doc.document_id
                ORDER BY fs.booking_created_at DESC";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {

            while($rec = $result->fetch_assoc()) {

                echo "<tr>";
                echo "<td>" . "<img src='../uploads/default_user_image.png' class='rounded-circle' width='55' height='55'>" . "</td>"; // Placeholder for photo
                echo "<td>" . $rec['title'] . " " . $rec['deceased_name'] . "</td>";
                echo "<td>" . $rec['nic'] . "</td>";
                echo "<td>" . $rec['gender'] . "</td>";
                echo "<td>" . $rec['date_of_death'] . "</td>";
                echo "<td>" . $rec['service_type'] . "</td>";
                echo "<td>" . $rec['religion'] . "</td>";

                echo "<td>" . "Pending" . "</td>"; // Placeholder for status

                echo "<td>
                        <a href='admin.php?page=view_deceased_details&booking_code=" . $rec['booking_code'] . "' class='btn btn-sm btn-outline-info'>
                            <i class='fa-solid fa-eye'></i>
                        </a>

                        <button class='btn btn-sm btn-outline-warning'>
                            <i class='fa-solid fa-pen'></i>
                        </button>

                        <button class='btn btn-sm btn-outline-danger'>
                            <i class='fa-solid fa-trash'></i>
                        </button>
                      </td>";
                echo "</tr>";
            }

        } else {
            echo "<tr><td colspan='8' class='text-center'>No deceased records found.</td></tr>";
        }
        
    }

    // Load detailed/compeleted deceased data view by using the booking code
    public function getDeceasedDetails_By_BookingCode($booking_code){

        $sql = "SELECT fs.booking_code,
                d.title, d.full_name, d.religion, d.nic, d.deceased_address, d.gender, d.date_of_birth, d.deceased_gn_division, d.municipal_council,
                a.applicant_name, a.relationship_to_deceased, a.contact_number, a.email, a.applicant_gn_division, a.applicant_address,
                doc.death_certificate_number, doc.registrar_name, doc.date_of_death, doc.cause_of_death, doc.coroner_name, doc.coroner_decision, doc.cremation_permission,
                    doc.death_certificate, doc.coroner_certificate, doc.family_consent_letter
                FROM funeral_service_table fs
                JOIN deceased_table d ON fs.deceased_table_deceased_id = d.deceased_id
                JOIN applicant_table a ON fs.applicant_table_applicant_id = a.applicant_id
                JOIN document_table doc ON fs.document_table_document_set_id = doc.document_id
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

}

?>