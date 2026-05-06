<?php
session_start();
include_once('main.php');
include_once('numberGeneration.php');

class BookingController extends MainController{

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

    public function saveDeceasedInformation($data) {

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

    public function saveDocumentInformation($data) {

        $death_certificate_number = $data['death_certificate_number'] ?? '';
        $registrar_name = $data['registrar_name'] ?? '';
        $date_of_death = $data['date_of_death'] ?? '';
        $cause_of_death = $data['cause_of_death'] ?? '';
        $death_certificate = $data['death_certificate'] ?? '';
        $cremation_permission = $data['cremation_permission'] ?? '';
        $family_consent_letter = $data['family_consent_letter'] ?? '';

        if (empty($death_certificate_number) || empty($registrar_name) || empty($date_of_death) || empty($cause_of_death) || empty($death_certificate) || 
            $cremation_permission === '' || empty($family_consent_letter)) {

            return "Please fill the required fields.";
        }

        $_SESSION['booking']['step2'] = $data;

        return "success";
    }

    public function getSlotsByDate($date) {

        $day = date('l', strtotime($date)); // Days of Week: Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday

        $sql = "SELECT s.*, CASE WHEN b.schedule_slots_table_slot_id IS NOT NULL THEN 1 ELSE 0 END AS is_booked FROM schedule_slots_table s 
                LEFT JOIN cremation_table b ON s.slot_id = b.schedule_slots_table_slot_id AND b.cremation_date = ? WHERE s.day_of_the_week = ? 
                ORDER BY s.start_time ASC";

    //     $sql = "
    //     SELECT 
    //         s.slot_id,
    //         s.start_time,
    //         s.end_time,
    //         s.is_active,
    //         s.slot_type,
    //         IF(b.schedule_slots_table_slot_id IS NOT NULL, 1, 0) AS is_booked
    //     FROM schedule_slots_table s
    //     LEFT JOIN cremation_table b 
    //         ON s.slot_id = b.schedule_slots_table_slot_id 
    //         AND b.cremation_date = ?
    //     WHERE s.day_of_the_week = ?
    //     ORDER BY s.start_time ASC
    // ";

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

    public function saveCremationInformation($data) {

        $cremation_date = $data['cremation_date'] ?? '';
        $area_type = $data['area_type'] ?? '';
        $cremation_time_slot = $data['cremation_time_slot'] ?? '';
        $cremation_permission = $data['cremation_permission'] ?? '';
        $ash_collection_method = $data['ash_collection_method'] ?? '';
        $notes = $data['notes'] ?? '';

        $memorial_design = $data['memorial_design'] ?? null;
        $memorial_image = $data['memorial_image'] ?? null;

        if (empty($cremation_date) || empty($area_type) || empty($cremation_time_slot) || $cremation_permission === '') {
            return "Please fill the required fields.";
        }

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
                "date" => $cremation_date,
                "area_type" => $area_type,
                "time_slot" => $cremation_time_slot,
                "permission" => $cremation_permission,
                "notes" => $notes
            ],

            "memorial" => ($ash_collection_method === "memorial") ? [
                "design" => $memorial_design,
                "image" => $memorial_image
            ] : null,

            "ash_collection_method" => $ash_collection_method
        ];

        return "success";
    }

}

?>