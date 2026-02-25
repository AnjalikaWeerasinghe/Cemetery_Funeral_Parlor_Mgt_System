<?php
session_start();
include_once('main.php');
include_once('numberGeneration.php');

class EmpController extends MainController{

    public function getNewStaffCode() {
        $number = new Numbering();
        return $number->generateUniqueNumber("staff_code", "staff_table", "CEM-STF-");
    }
    
    public function insert_staff($data) {
        $number = new Numbering();
        $staffCode = $number->generateUniqueNumber("staff_code", "staff_table", "CEM-STF-");

        $hashedPassword = password_hash($data['password_hash'], PASSWORD_DEFAULT);

        $sql_query = "INSERT INTO staff_table (staff_code, first_name, middle_name, last_name, nic, gender, date_of_birth, 
            contact_number, address, role_id, employement_type, date_joined, staff_status, salary, email, password_hash, image, system_role)
        
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        ;

        $sql = $this->conn->prepare($sql_query);

        $sql->bind_param("sssssssssisssdssss",
            $staff_code, $data['first_name'], $data['middle_name'], $data['last_name'], $data['nic'], $data['gender'], $data['date_of_birth'],
            $data['contact_number'], $data['address'], $data['role_id'], $data['employement_type'], $data['date_joined'], $data['staff_status'],
            $data['salary'], $data['email'], $data['password_hash'], $data['image'], $data['system_role']
        );

        if ($sql->execute()) {
            return "success";
        } else {
            return "error";
        }

        $sql->close();
    }
}


?>