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

        $data['salary'] = !empty($data['salary']) ? $data['salary'] : 0;

        $sql_query = "INSERT INTO staff_table (staff_code, first_name, middle_name, last_name, nic, gender, date_of_birth, 
            contact_number, address, role_id, employement_type, date_joined, staff_status, salary, email, password_hash, image, system_role)
        
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        ;

        $sql = $this->conn->prepare($sql_query);

        $sql->bind_param("sssssssssisssdssss",
            $staffCode, $data['first_name'], $data['middle_name'], $data['last_name'], $data['nic'], $data['gender'], $data['date_of_birth'],
            $data['contact_number'], $data['address'], $data['role_id'], $data['employement_type'], $data['date_joined'], $data['staff_status'],
            $data['salary'], $data['email'], $hashedPassword, $data['image'], $data['system_role']
        );

        if ($sql->execute()) {
            return "success";
        } else {
            return "error";
        }

        $sql->close();
    }

    public function view_Staff_Data() {

    $sqlView = "SELECT * FROM staff_table ORDER BY staff_id DESC;";
    $resultView = $this->conn->query($sqlView);

        if($resultView && $resultView->num_rows > 0){

            while($rec = $resultView->fetch_assoc()){

                echo "<tr>";
                echo "<td>".$rec['staff_code']."</td>";
                echo "<td>".$rec['first_name']." ".$rec['last_name']."</td>";
                echo "<td>".$rec['email']."</td>";
                echo "<td>".$rec['system_role']."</td>";
                echo "<td>".$rec['staff_status']."</td>";

                echo "<td class=\"align-items-center\">
                        <button class='btn btn-warning btn-sm edit' id='".$rec['staff_id']."'>
                                <i class=\"fa-solid fa-file-pen\"></i>
                        </button>
                        <button class='btn btn-danger btn-sm delete' id='".$rec['staff_id']."'>
                                <i class=\"fa-solid fa-trash\"></i>
                        </button>
                    </td>";

                echo "</tr>";
            }

        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        
    }

    public function getDatatoEdit($id) {
        
    $sqlEdit = "SELECT * FROM staff_table WHERE staff_id = '$id';";
    $resultEdit = $this->conn->query($sqlEdit);

    $nor = $resultEdit->num_rows;
        if($nor > 0){
            $rec = $resultEdit->fetch_assoc();
            echo json_encode($rec);
        }
        else{
            echo "No data found";
        }

    }

}


?>