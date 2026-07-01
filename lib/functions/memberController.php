<?php
session_start();
include_once('main.php');
include_once('numberGeneration.php');

class MemberController extends MainController {

    public function getNewMemberCode() {
        $number = new Numbering();
        return $number->generateUniqueNumber("member_code", "member_table", "CEM-MEM-");
    }

    public function addNewMember($data) {

        if (!$this->conn) {
            die("Database connection is NULL");
        }

        

        $number = new Numbering();
        $memberCode =  $number->generateUniqueNumber("member_code", "member_table", "CEM-MEM-");

        $hashedPassword = password_hash($data['password_hash'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO member_table (first_name, middle_name, last_name, nic, gender, date_of_birth, contact_number, address, email,
                password_hash, member_status, image, member_code)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        ;

        $result = $this->conn->prepare($sql);

        if (!$result) {
        die("Prepare failed: " . $this->conn->error);
        }

        $result->bind_param("sssssssssssss",
            $data['first_name'], $data['middle_name'], $data['last_name'], $data['nic'], $data['gender'], $data['date_of_birth'],
            $data['contact_number'], $data['address'], $data['email'], $hashedPassword, $data['member_status'], $data['image'], $memberCode
        );

        $success = $result->execute();

        if (!$success) {
        die("Execute failed: " . $result->error);
        }

        $result->close();

        return "success";
    }

    public function view_Member_Data() {

        $sqlView = "SELECT * FROM member_table ORDER BY member_id DESC;";
        $resultView = $this->conn->query($sqlView);

        if($resultView && $resultView->num_rows > 0){

            while($rec = $resultView->fetch_assoc()){

                echo "<tr>";
                echo "<td>".$rec['member_code']."</td>";
                echo "<td>".$rec['first_name']." ".$rec['last_name']."</td>";
                echo "<td>".$rec['email']."</td>";
                echo "<td>".$rec['member_status']."</td>";

                echo "<td >
                        <button type='button' class='btn btn-warning btn-sm edit' id='".$rec['member_id']."'>
                                <i class=\"fa-solid fa-file-pen\"></i>
                        </button>   
                    </td>";

                echo "<td>
                        <button class='btn btn-danger btn-sm delete' id='".$rec['member_id']."'>
                                <i class=\"fa-solid fa-trash\"></i>
                        </button>
                    </td>";

                echo "</tr>";
            }

        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
    }

    public function deleteMember($id) {

        $sqlDel = "UPDATE member_table SET member_status = 'Inactive' WHERE member_id = '$id';";
        $resultDel = $this->conn->query($sqlDel);

        if($resultDel > 0){
            echo("success");
        } else{
            echo("error");
        }
    }

    public function getMemberById($id) {

        $sqlGetMember = "SELECT * FROM member_table WHERE member_id = ?";

        $resultSql = $this->conn->prepare($sqlGetMember);
        $resultSql->bind_param("i", $id);
        $resultSql->execute();

        $result = $resultSql->get_result();

        return $result->fetch_assoc();
    }

    public function updateMember($data) {

        $gender = !empty($data['gender']) ? $data['gender'] : NULL;
        $date_of_birth = !empty($data['date_of_birth']) ? $data['date_of_birth'] : NULL;

        $sql = "UPDATE member_table SET first_name = ?, middle_name = ?, last_name = ?, nic = ?, gender = ?, date_of_birth = ?, 
                contact_number = ?, address = ?, email = ?, member_status = ? WHERE member_id = ? ";

        $result = $this->conn->prepare($sql);

        $result->bind_param("ssssssssssi",
            $data['first_name'], $data['middle_name'], $data['last_name'], $data['nic'], $gender, $date_of_birth, $data['contact_number'],
            $data['address'], $data['email'], $data['member_status'], $data['member_id']
        );

        return $result->execute() ? "updated" : "error";
    }

    public function registerNewMember($data) {

        if($data['password'] != $data['confirm_password']){
            return "Passwords do not match";
        }

        $sql = "SELECT member_id FROM member_table WHERE email = ? OR nic = ? ";

        $result = $this->conn->prepare($sql);

        $result->bind_param("ss", 
            $data['email'], $data['nic']
        );

        $result->execute();

        if($result->get_result()->num_rows > 0){
            return "Email or NIC already exists";
        }

        $number = new Numbering();
        $memberCode =  $number->generateUniqueNumber("member_code", "member_table", "CEM-MEM-");

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->conn->begin_transaction();

        try {
            // Insert new member to the login table
            $loginInsertSql = "INSERT INTO login_table (user_name, user_email, login_password, user_role, user_status)
                        VALUES (?, ?, ?, 'Member', 1)";

            $result = $this->conn->prepare($loginInsertSql);

            $userName = $data['first_name']. " " . $data['last_name'];

            $result->bind_param("sss",
                    $userName, $data['email'], $hashedPassword);

            $result->execute();

            $loginUserId = $this->conn->insert_id;

            // Insert new member to the member table
            $memberInsertSql = "INSERT INTO member_table (member_code, first_name, middle_name, last_name, nic, gender, date_of_birth, 
                contact_number, address, email, password_hash, member_status, image, login_table_user_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Active', '', ?)";

            $result = $this->conn->prepare($memberInsertSql);

            $result->bind_param("ssssssssssssss",
            $memberCode, $data['first_name'], $data['middle_name'], $data['last_name'], $data['nic'], $data['gender'], $data['date_of_birth'],
            $data['contact_number'], $data['address'], $data['email'], $hashedPassword, $data['member_status'], $data['image'], $loginUserId);

            $result->execute();

            $this->conn->commit();

            return "success";            

        } catch (Exception $e) {
            $this->conn->rollback();

            return $e->getMessage();
        }

        return "success";
        
    }

}

?>