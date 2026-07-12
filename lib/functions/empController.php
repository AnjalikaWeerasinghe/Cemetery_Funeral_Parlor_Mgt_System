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

        if (!$this->conn) {
            die("Database connection is NULL");
        }

        $sqlExistNICEmail = "SELECT staff_id FROM staff_table WHERE email = ? OR nic = ?";

        $resultExist = $this->conn->prepare($sqlExistNICEmail);

        $resultExist->bind_param("ss", $data['email'], $data['nic']);

        $resultExist->execute();

        if ($resultExist->get_result()->num_rows > 0) {
            return "Email or NIC already exists";
        }

        $number = new Numbering();
        $staffCode = $number->generateUniqueNumber("staff_code", "staff_table", "CEM-STF-");

        $hashedPassword = password_hash($data['password_hash'], PASSWORD_DEFAULT);

        $this->conn->begin_transaction();

        try {
            // Login table insertion
            $loginSql = "INSERT INTO login_table (user_name, user_email, login_password, user_role, user_status)
                VALUES (?, ?, ?, 'Staff', 1)";

            $resultLogin = $this->conn->prepare($loginSql);

            $userName = $data['first_name'] . " " . $data['last_name'];

            $resultLogin->bind_param("sss", $userName, $data['email'], $hashedPassword);

            $resultLogin->execute();

            $loginUserId = $this->conn->insert_id;

            // Staff table insertion
            $sql_query = "INSERT INTO staff_table (staff_code, first_name, middle_name, last_name, nic, gender, date_of_birth, 
                contact_number, address, role_id, employement_type, date_joined, staff_status, salary, email, password_hash, image, system_role, login_table_user_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $result = $this->conn->prepare($sql_query);

            if (!$result) {
                throw new Exception($this->conn->error);
            }

            $result->bind_param("sssssssssisssdssssi",
                $staffCode, $data['first_name'], $data['middle_name'], $data['last_name'], $data['nic'], $data['gender'], $data['date_of_birth'],
                $data['contact_number'], $data['address'], $data['role_id'], $data['employement_type'], $data['date_joined'], $data['staff_status'],
                $data['salary'], $data['email'], $hashedPassword, $data['image'], $data['system_role'], $loginUserId
            );

            $success = $result->execute();

            if (!$success) {
                throw new Exception($result->error);
            }

            $result->close();

            $this->conn->commit();

            return "success";

        } catch (Exception $e) {
            $this->conn->rollback();

            return $e->getMessage();
        }
        
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