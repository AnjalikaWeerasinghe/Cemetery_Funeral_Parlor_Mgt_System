<?php
session_start();
include_once('main.php');
include_once('numberGeneration.php');

// Purpose: This class contains methods for managing funeral booking operations
class BookingController extends MainController{

    // This function generates a unique booking code based on the selected service type
    public function getNewBookingCode($service_type) {
        $number = new Numbering();

        if($service_type == "Cremation"){
            $prefix = "CEM-CRM-";
        } else if($service_type == "Burial") {
            $prefix = "CEM-BRL-";
        } else {
            $prefix = "CEM-PRL-";
        }

        return $number->generateUniqueNumber("booking_code", "funeral_service_table", $prefix);
    }

    // This function generates a unique payment code for the payment record
    public function generatePaymentCode() {
        $number = new Numbering();
        return $number->generateUniqueNumber("payment_code", "payment_table", "PAY-");
    }

    // This function generates a unique transaction reference for payment processing
    public function generateTransactionReference() {
        return "TRC-" . strtoupper(bin2hex(random_bytes(5)));
    }

    // This function saves the deceased and applicant information to the session for later use in the booking process. 
    // It also performs basic validation on the required fields.
    public function saveDeceasedInformation($data, $files = []) {

        $full_name = $data['full_name'] ?? '';
        $nic = $data['nic'] ?? '';

        $applicant_name = $data['applicant_name'] ?? '';
        $relationship_to_deceased = $data['relationship_to_deceased'] ?? '';
        $contact_number = $data['contact_number'] ?? '';
        $applicant_address = $data['applicant_address'] ?? '';

        if (empty($full_name) || empty($nic) || empty($applicant_name) || empty($relationship_to_deceased) || empty($contact_number) || 
        empty($applicant_address)) {

            echo "Please fill the required fields.";
            exit();
        }

        $_SESSION['booking']['step1'] = $data;

        return "success";
    }

    // This function saves the document information to the session for later use in the booking process.
    public function saveDocumentInformation($data) {

        $death_certificate_number = $data['death_certificate_number'] ?? '';
        $registrar_name = $data['registrar_name'] ?? '';
        $date_of_death = $data['date_of_death'] ?? '';
        $cause_of_death = $data['cause_of_death'] ?? '';

        $cremation_permission = $data['cremation_permission'] ?? '';

        if (
            empty($death_certificate_number) ||
            empty($registrar_name) ||
            empty($date_of_death) ||
            empty($cause_of_death) ||
            $cremation_permission === ''
        ) {
            return "Please fill the required fields.";
        }

        return "success";
    }

    // This function retrieves the available schedule slots for a given date, along with their booking status, to help users select a suitable time for the cremation service.
    public function getSlotsByDate($date) {

        $day = date('l', strtotime($date)); // Days of Week: Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday

        $sql = "SELECT s.*, CASE WHEN b.schedule_slots_table_slot_id IS NOT NULL THEN 1 ELSE 0 END AS is_booked FROM schedule_slots_table s 
                LEFT JOIN cremation_table b ON s.slot_id = b.schedule_slots_table_slot_id AND b.cremation_date = ? WHERE s.day_of_the_week = ? 
                ORDER BY s.start_time ASC";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            die("SQL ERROR: " . $this->conn->error);
        }

        $stmt->bind_param("ss", $date, $day);
        $stmt->execute();

        $result = $stmt->get_result();

        $slots = [];
        while($row = $result->fetch_assoc()){
            $slots[] = $row;
        }
        return $slots;
    }

    // This function saves the cremation and memorial information to the session for later use in the booking process. 
    // It also performs validation on the required fields and handles the memorial design data if the user chooses to collect ashes through a memorial service.
    public function saveCremationInformation($data, $files = []) {

        $cremation_date = $data['cremation_date'] ?? '';
        $area_type = $data['area_type'] ?? '';
        $schedule_slots_table_slot_id  = $data['schedule_slots_table_slot_id'] ?? '';
        $collect_ash = $data['collect_ash'] ?? '';
        $ash_collection_method = $data['ash_collection_method'] ?? '';
        $notes = $data['notes'] ?? '';

        $memorial_design = $data['memorial_design'] ?? null;
        // $memorial_image = $data['memorial_image'] ?? null;

        if (empty($cremation_date) || empty($area_type) || empty($schedule_slots_table_slot_id ) || $collect_ash === '') {
            return "Please fill the required fields.";
        }

        $decodedDesign = null;

        if ($ash_collection_method === "memorial") {

            if (empty($memorial_design)) {
                return "Memorial design is required.";
            }

            $decodedDesign = json_decode($memorial_design, true);

            if (!$decodedDesign) {
                return "Invalid memorial design data.";
            }
        }

        $_SESSION['booking']['step3'] = [
            "cremation" => [
                "cremation_date" => $cremation_date,
                "area_type" => $area_type,
                "schedule_slots_table_slot_id" => $schedule_slots_table_slot_id,
                "collect_ash" => $collect_ash,
                "notes" => $notes
            ],

            "ash_collection_method" => $ash_collection_method,

            "memorial" => ($ash_collection_method === "memorial") ? [
                "design" => $decodedDesign,
                "image" => $files['memorial_image']['name'] ?? null
            ] : null

        ];

        return "success";
    }

    // This function saves the payment information to the session for later use in the booking process. 
    // It also performs validation on the required fields to ensure that payment details are complete before proceeding to the final booking confirmation step.
    public function savePaymentInformation($data) {
        
        if(empty($data['payment_method']) || empty($data['total_payment'])) {
            return "Payment details are missing.";
        }

        $_SESSION['booking']['payment'] = $data;

        return "success";
    }

    // This function saves all the booking data to the database after the final step
    public function confirmCremationBooking() {
        // echo "<pre>";

        // echo "step1: ";
        // var_dump(isset($_SESSION['booking']['step1']));

        // echo "step2: ";
        // var_dump(isset($_SESSION['booking']['step2']));

        // echo "step3: ";
        // var_dump(isset($_SESSION['booking']['step3']));

        // echo "payment: ";
        // var_dump(isset($_SESSION['booking']['payment']));

        // print_r($_SESSION['booking']);

        // echo "</pre>";
        // exit;

if (!isset($_SESSION['booking']['step1']) || 
    !isset($_SESSION['booking']['step2']) || 
    !isset($_SESSION['booking']['step3']) ||
    !isset($_SESSION['booking']['payment'])) {
    return "Incomplete booking data.";
}

        if (!isset($_SESSION['booking']['step1']) || 
            !isset($_SESSION['booking']['step2']) || 
            !isset($_SESSION['booking']['step3']) ||
            !isset($_SESSION['booking']['payment'])) {
                return "Incomplete booking data.";
        }

        if(!isset($_SESSION['booking']['booking_code'])){

            $_SESSION['booking']['booking_code'] =
                $this->getNewBookingCode("Cremation");
        }

        $booking_code = $_SESSION['booking']['booking_code'];

        $step1 = $_SESSION['booking']['step1'];
        $step2 = $_SESSION['booking']['step2'];
        $step3 = $_SESSION['booking']['step3'];
        $step4 = $_SESSION['booking']['payment'];

        // Begin database transaction
        // Ensures all booking-related inserts succeed or rollback together
        $this->conn->begin_transaction();

        try{
            //Step 1 insertion - Deceased and Applicant Information
            $checkSql = "SELECT deceased_id FROM deceased_table WHERE nic = ?";

            $checkStmt = $this->conn->prepare($checkSql);

            $checkStmt->bind_param("s", $step1['nic']);

            $checkStmt->execute();

            $result = $checkStmt->get_result();

            if($result->num_rows > 0){

                $row = $result->fetch_assoc();
                $deceased_id = $row['deceased_id'];

            } else {

                $sql1 = "INSERT INTO deceased_table (
                        full_name, title, religion, deceased_photo, nic, gender, date_of_birth, deceased_address, deceased_gn_division, municipal_council)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
                $stmt1 = $this->conn->prepare($sql1);

                $stmt1->bind_param("ssssssssss", 
                    $step1['full_name'], $step1['title'], $step1['religion'], $step1['deceased_photo'], $step1['nic'], $step1['gender'], $step1['date_of_birth'], $step1['deceased_address'], $step1['deceased_gn_division'], $step1['municipal_council']
                );

                if(!$stmt1->execute()){
                    throw new Exception($stmt1->error);
                }

                $deceased_id = $stmt1->insert_id;

            }

            $sql2 = "INSERT INTO applicant_table (
                    applicant_name, relationship_to_deceased, contact_number, email, applicant_gn_division, applicant_address)
                    VALUES (?, ?, ?, ?, ?, ?)";

            $stmt2 = $this->conn->prepare($sql2);

            $stmt2->bind_param("ssssss", 
                $step1['applicant_name'], $step1['relationship_to_deceased'], $step1['contact_number'], $step1['email'], $step1['applicant_gn_division'], $step1['applicant_address']
            );

            if(!$stmt2->execute()){
                throw new Exception($stmt2->error);
            }

            $applicant_id = $stmt2->insert_id;

            //Step 2 insertion - Document Information
            $coroner_name = $step2['coroner_name'] ?? null;

            $coroner_decision = $step2['coroner_decision'] ?? null;

            $coroner_certificate = $step2['coroner_certificate'] ?? null;

            $sql3  = "INSERT INTO document_table (
                    death_certificate_number, registrar_name, date_of_death, cause_of_death, coroner_name, coroner_decision, cremation_permission, verification_status,
                    death_certificate, coroner_certificate, family_consent_letter)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt3 = $this->conn->prepare($sql3);

            $stmt3->bind_param("ssssssissss", 
                $step2['death_certificate_number'], $step2['registrar_name'], $step2['date_of_death'], $step2['cause_of_death'], $coroner_name, $coroner_decision, $step2['cremation_permission'], $step2['verification_status'],
                $step2['death_certificate'], $coroner_certificate, $step2['family_consent_letter']
            );

            if(!$stmt3->execute()){
                throw new Exception($stmt3->error);
            }

            $document_id = $stmt3->insert_id;

            // Insertion to the main booking table with foreign keys from the above tables - funeral_service_table

            $service_type = "Cremation";

            $booking_status = "Pending"; // Initial status before payment confirmation

            $booking_created_at = date("Y-m-d H:i:s");

            $sql4 = "INSERT INTO funeral_service_table (
                    booking_code, service_type, booking_status, booking_created_at, 
                    deceased_table_deceased_id, applicant_table_applicant_id, document_table_document_set_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt4 = $this->conn->prepare($sql4);

            if(!$stmt4){
                die("SQL4 Error: " . $this->conn->error);
            }

            $stmt4->bind_param("ssssiii", 
                $booking_code, $service_type, $booking_status, $booking_created_at,
                $deceased_id, $applicant_id, $document_id
            );

            if(!$stmt4->execute()){
                throw new Exception($stmt4->error);
            }

            $funeral_service_id = $stmt4->insert_id;

            // Step 3 insertion - Cremation and Memorial Information

            $sql5 = "INSERT INTO cremation_table (
                    cremation_date, area_type, collect_ash, ash_collection_method, notes, schedule_slots_table_slot_id, funeral_service_table_funeral_service_id)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt5 = $this->conn->prepare($sql5);

            $stmt5->bind_param("ssissii", 
                $step3['cremation']['cremation_date'], $step3['cremation']['area_type'], $step3['cremation']['collect_ash'], $step3['ash_collection_method'], $step3['cremation']['notes'], $step3['cremation']['schedule_slots_table_slot_id'], $funeral_service_id
            );

            if(!$stmt5->execute()){
                throw new Exception($stmt5->error);
            }

            // If memorial design is provided, insert into memorial_table

            if ($step3['ash_collection_method'] === "memorial") {

                $design = $step3['memorial']['design'];

                if(is_string($design)){
                    $design = json_decode($design, true);
                }

                if(!is_array($design)){
                    throw new Exception("Invalid memorial design data.");
                }

                $name = isset($design['name']) ? (string)$design['name'] : '';
                $message = isset($design['message']) ? (string)$design['message'] : '';
                $icon = isset($design['icon']) ? (string)$design['icon'] : '';
                $font = isset($design['font']) ? (string)$design['font'] : '';
                $theme = isset($design['theme']) ? (string)$design['theme'] : '';

                $image = isset($step3['memorial']['image'])
                    ? (string)$step3['memorial']['image']
                    : '';

                $sql6 = "INSERT INTO memorial_service_table (
                memorial_name, memorial_message, memorial_icon, font_style, tablet_theme, memorial_image, funeral_service_table_funeral_service_id)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

                $stmt6 = $this->conn->prepare($sql6);

                if(!$stmt6){
                    die("Memorial SQL Error: " . $this->conn->error);
                }

                $stmt6->bind_param("ssssssi", 
                    $design['name'], $design['message'], $icon, $font, $theme, $step3['memorial']['image'], $funeral_service_id
                );

                // echo "<pre>";

                // var_dump($design['name']);
                // var_dump($design['message']);
                // var_dump($icon);
                // var_dump($font);
                // var_dump($theme);
                // var_dump($step3['memorial']['image']);
                // var_dump($funeral_service_id);

                // exit;

                if(!$stmt6->execute()){
                    throw new Exception($stmt6->error);
                }

            }

            // Step 4 insertion - Payment Information

            $sql7 = "INSERT INTO payment_table (
                    payment_code, payment_method, payment_status, transaction_reference, service_cost, memorial_cost, total_payment, paid_amount, payment_date, funeral_service_table_funeral_service_id)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt7 = $this->conn->prepare($sql7);

            if(!$stmt7){
                die("Payment SQL Error: " . $this->conn->error);
            }

            $stmt7->bind_param("ssssddddsi", 
                $step4['payment_code'], $step4['payment_method'], $step4['payment_status'], $step4['transaction_reference'], $step4['service_cost'], $step4['memorial_cost'], $step4['total_payment'], $step4['paid_amount'], $step4['payment_date'], $funeral_service_id
            );

            if(!$stmt7->execute()){
                throw new Exception($stmt7->error);
            }

            $this->conn->commit();

            unset($_SESSION['booking']); // Clear session data after database insertion

            return [
                "status" => "success",
                "booking_code" => $booking_code
            ];

        }
        catch(Exception $e){

            $this->conn->rollback();
            return "Error saving booking: " . $e->getMessage();

        }

    }

    // Retreive summery of funeral booking to display in the funeral booking table
    public function view_Booking_Data() {

        $sql = "SELECT fs.booking_code, d.full_name AS deceased_name, doc.date_of_death, a.applicant_name, a.contact_number, fs.service_type
                FROM funeral_service_table fs
                JOIN deceased_table d ON fs.deceased_table_deceased_id = d.deceased_id
                JOIN applicant_table a ON fs.applicant_table_applicant_id = a.applicant_id
                JOIN document_table doc ON fs.document_table_document_set_id = doc.document_id
                WHERE fs.booking_status = 'Pending'
                ORDER BY fs.booking_created_at DESC";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            
            while($rec = $result->fetch_assoc()) {

                echo "<tr>";
                echo "<td>".$rec['booking_code']."</td>";
                echo "<td>".$rec['deceased_name']."</td>";
                echo "<td>".$rec['date_of_death']."</td>";
                echo "<td>".$rec['applicant_name']."</td>";
                echo "<td>".$rec['contact_number']."</td>";
                echo "<td>".$rec['service_type']."</td>";

                echo "<td>
                        <a href='admin.php?page=view_funeral_booking&booking_code=".$rec['booking_code']."' class='btn btn-sm btn-outline-info'>
                            <i class='fa-solid fa-eye'></i> 
                        </a>

                        <button class='btn btn-danger btn-sm delete' id='".$rec['booking_code']."'>
                            <i class=\"fa-solid fa-trash\"></i> 
                        </button>
                     </td>";
                echo "</tr>";
            }
            
        } else {
            return "<tr><td colspan='7' class='text-center'>No bookings found.</td></tr>";
        }
    }

    public function saveParlorInformation() {

        $district = $_POST["district"] ?? '';
        $urban_council_division = $_POST["urban_council_division"] ?? '';
        $parlor_name = $_POST["parlor_name"] ?? '';

        $start_date = $_POST["start_date"] ?? '';
        $start_time = $_POST["start_time"] ?? '';
        $end_date = $_POST["end_date"] ?? '';
        $end_time = $_POST["end_time"] ?? '';

        $total_cost = $_POST["parlor_cost"] ?? '';

        if (empty($start_date) || empty($start_time) || empty($end_date) || empty($end_time)) {
            return "Please fill the required fields.";
        }

        return "success";

    }

    public function getFuneralBookingDetails_By_BookingCode($booking_code) {

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

    // public function getDeceasedByBookingId($bookingCode){

    //     $sql = "SELECT * FROM funeral_service_table WHERE booking_code = ?";

    //     $stmt = $this->conn->prepare($sql);
    //     if (!$stmt) {
    //         return ["error" => "Prepare failed"];
    //     }

    //     $stmt->bind_param("s", $bookingCode);
    //     $stmt->execute();

    //     $result = $stmt->get_result();
    //     $data = $result->fetch_assoc();

    //     return $data ?: [];
        
    // }

}

?>