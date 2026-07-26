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

        $sqlExistNICEmail = "SELECT member_id FROM member_table WHERE email = ? OR nic = ?";

        $resultExist = $this->conn->prepare($sqlExistNICEmail);

        $resultExist->bind_param("ss", $data['email'], $data['nic']);

        $resultExist->execute();

        if ($resultExist->get_result()->num_rows > 0) {
            return "Email or NIC already exists";
        }

        $number = new Numbering();
        $memberCode =  $number->generateUniqueNumber("member_code", "member_table", "CEM-MEM-");

        $hashedPassword = password_hash($data['password_hash'], PASSWORD_DEFAULT);

        $this->conn->begin_transaction();

        try {
            // Insert into login table
            $loginSql = "INSERT INTO login_table (user_name, user_email, login_password, user_role, user_status)
                VALUES (?, ?, ?, 'Member', 1)";

            $resultLogin = $this->conn->prepare($loginSql);

            $userName = $data['first_name'] . " " . $data['last_name'];

            $resultLogin->bind_param("sss", $userName, $data['email'], $hashedPassword);

            $resultLogin->execute();

            $loginUserId = $this->conn->insert_id;

            // Insert into member table
            $sql = "INSERT INTO member_table (first_name, middle_name, last_name, nic, gender, date_of_birth, contact_number, address, email,
                password_hash, member_status, image, member_code, login_table_user_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $result = $this->conn->prepare($sql);

            if (!$result) {
                throw new Exception($this->conn->error);
            }

            $result->bind_param("sssssssssssssi",
                $data['first_name'], $data['middle_name'], $data['last_name'], $data['nic'], $data['gender'], $data['date_of_birth'],
                $data['contact_number'], $data['address'], $data['email'], $hashedPassword, $data['member_status'], $data['image'], $memberCode, $loginUserId
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

    public function view_Member_Data($search = "") {

        if(!empty($search)) {
            $sqlView = "SELECT * FROM member_table 
                WHERE member_code LIKE ? OR first_name LIKE ? OR middle_name LIKE ? OR last_name LIKE ? OR nic LIKE ? OR email LIKE ? OR contact_number LIKE ? OR address LIKE ?
                ORDER BY member_id DESC";

            $resultView = $this->conn->prepare($sqlView);

            $keyword = "%$search%";

            $resultView->bind_param("ssssssss", $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword);

            $resultView->execute();

            $resultView = $resultView->get_result();
        } else {
            $sqlView = "SELECT * FROM member_table ORDER BY member_id DESC";

            $resultView = $this->conn->query($sqlView);
        }

        if($resultView && $resultView->num_rows > 0){

            while($rec = $resultView->fetch_assoc()){

                $initials = strtoupper(substr($rec['first_name'],0,1).substr($rec['last_name'],0,1));

                echo "<tr>";

                echo "<td><span class='badge bg-light text-dark border px-3 py-2 fw-semibold'>{$rec['member_code']}</span></td>";

                echo "<td>
                    <div class='d-flex align-items-center'>
                        <div class='rounded-circle bg-primary text-white d-flex justify-content-center align-items-center fw-bold me-3' style='width:45px;height:45px;font-size:16px;'>
                            {$initials}
                        </div>

                        <div>
                            <div class='fw-semibold text-dark'>
                                {$rec['first_name']} {$rec['last_name']}
                            </div>
                            <small class='text-muted'>NIC : {$rec['nic']}</small>
                        </div>
                    </div>
                </td>";

                echo "<td><i class='fa-solid fa-envelope text-secondary me-2'></i><span class='text-muted'>{$rec['email']}</span></td>";

                if($rec['member_status']=="Active"){
                    echo "<td>
                        <span class='badge rounded-pill bg-success-subtle text-success border border-success px-3 py-2'><i class='fa-solid fa-circle-check me-1'></i>Active</span>
                    </td>";
                }else{
                    echo "<td>
                        <span class='badge rounded-pill bg-secondary-subtle text-secondary border px-3 py-2'><i class='fa-solid fa-user-slash me-1'></i>Inactive</span>
                    </td>";
                }

                echo "<td>";

                echo "<div class='btn-group' role='group'>";

                echo "
                    <button class='btn btn-outline-info btn-sm view' data-id='{$rec['member_id']}' data-bs-toggle='tooltip' title='View Member'>
                        <i class='fa-solid fa-eye'></i>
                    </button>
                ";

                echo "
                    <button class='btn btn-outline-primary btn-sm edit' data-id='".$rec['member_id']."' data-bs-toggle='tooltip' title='Edit Member'>
                        <i class='fa-solid fa-pen'></i>
                    </button>
                ";

                if($rec['member_status']=="Active"){
                    echo "
                        <button class='btn btn-outline-warning btn-sm member-status' data-status='Inactive' data-name='{$rec['first_name']} {$rec['last_name']}' id='".$rec['member_id']."' data-bs-toggle='tooltip' title='Deactivate Member'>
                            <i class='fa-solid fa-user-slash'></i>
                        </button>
                    ";
                } else {
                    echo "
                        <button class='btn btn-outline-success btn-sm member-status' data-status='Active' data-name='{$rec['first_name']} {$rec['last_name']}' id='".$rec['member_id']."' data-bs-toggle='tooltip' title='Activate Member'>
                            <i class='fa-solid fa-user-check'></i>
                        </button>
                    ";
                }

                echo "</div>";

                echo "</td>";

                echo "</tr>";
            }

        } else {
            echo "<tr>
                <td colspan='5' class='text-center py-5'>
                    <i class='fa-solid fa-users fa-3x text-secondary mb-3'></i>
                    <h5 class='text-muted'>No Members Found</h5>
                    <small class='text-secondary'>There are currently no registered members.</small>
                </td>
            </tr>";
        }
    }

    public function activateDeactivateMember($id, $status) {

        $this->conn->begin_transaction();

        try {

            if($status == "Active"){
                $memberStatus = "Active";
                $loginStatus = 1;
            }else{
                $memberStatus = "Inactive";
                $loginStatus = 0;
            }

            // Deactivate member from member table
            $sqlMember = "UPDATE member_table SET member_status = ? WHERE member_id = ?";

            $stmt = $this->conn->prepare($sqlMember);

            if(!$stmt){
                throw new Exception($this->conn->error);
            }

            $stmt->bind_param("si", $memberStatus, $id);

            if(!$stmt->execute()){
                throw new Exception($stmt->error);
            }

            // Deactivate login account
            $sqlLogin = "UPDATE login_table l INNER JOIN member_table m ON l.user_id = m.login_table_user_id SET l.user_status = ? 
                WHERE m.member_id = ?";

            $stmtLogin = $this->conn->prepare($sqlLogin);

            if(!$stmtLogin){
                throw new Exception($this->conn->error);
            }

            $stmtLogin->bind_param("ii", $loginStatus, $id);

            if(!$stmtLogin->execute()){
                throw new Exception($stmtLogin->error);
            }

            $this->conn->commit();

            return "success";

        } catch (Exception $e) {

            $this->conn->rollback();

            return $e->getMessage();
        }
    }

    public function getMemberById($id) {

        $sqlGetMember = "SELECT * FROM member_table WHERE member_id = ?";

        $resultSql = $this->conn->prepare($sqlGetMember);

        $resultSql->bind_param("i", $id);

        $resultSql->execute();

        $result = $resultSql->get_result()->fetch_assoc();

        if (!$result) {
            return ["error" => "Member not found"];
        }

        unset($result['password_hash']);
        return $result;
    }

    public function updateMember($data) {

        $gender = !empty($data['gender']) ? $data['gender'] : NULL;

        $date_of_birth = !empty($data['date_of_birth']) ? $data['date_of_birth'] : NULL;

        $this->conn->begin_transaction();

        try{
            // Update member data in member table
            $sql = "UPDATE member_table SET first_name = ?, middle_name = ?, last_name = ?, nic = ?, gender = ?, date_of_birth = ?, 
                    contact_number = ?, address = ?, image = ?, email = ?, member_status = ? WHERE member_id = ? ";

            $result = $this->conn->prepare($sql);

            $result->bind_param("sssssssssssi",
                $data['first_name'], $data['middle_name'], $data['last_name'], $data['nic'], $gender, $date_of_birth, $data['contact_number'],
                $data['address'], $data['image'], $data['email'], $data['member_status'], $data['member_id']
            );

            $result->execute();

            $userName = $data['first_name'] . " " . $data['last_name'];

            $userStatus = ($data['member_status'] == "Active") ? 1 : 0;

            $sqlLogin = "UPDATE login_table l INNER JOIN member_table m ON l.user_id = m.login_table_user_id
                SET l.user_name = ?, l.user_email = ?, l.user_status = ? WHERE m.member_id = ?";

            $resultLogin = $this->conn->prepare($sqlLogin);

            $resultLogin->bind_param("ssii", $userName, $data['email'], $userStatus, $data['member_id']);

            $resultLogin->execute();

            $this->conn->commit();

            return "success";

        } catch (Exception $e) {

            $this->conn->rollback();

            return $e->getMessage();
        }

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

            if(!$result){
                throw new Exception($this->conn->error);
            }

            $userName = $data['first_name']. " " . $data['last_name'];

            $result->bind_param("sss",
                    $userName, $data['email'], $hashedPassword);

            if(!$result->execute()){
                throw new Exception($result->error);
            }

            $loginUserId = $this->conn->insert_id;

            // Insert new member to the member table
            $memberInsertSql = "INSERT INTO member_table (member_code, first_name, last_name, nic, contact_number, address, email, 
                password_hash, member_status, login_table_user_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Active', ?)";

            $result = $this->conn->prepare($memberInsertSql);

            if(!$result){
                throw new Exception($this->conn->error);
            }

            $result->bind_param("ssssssssi",
                $memberCode, $data['first_name'], $data['last_name'], $data['nic'], $data['contact_number'], $data['address'], 
                $data['email'], $hashedPassword, $loginUserId);

            if(!$result->execute()){
                throw new Exception($result->error);
            }

            $this->conn->commit();

            return "success";            

        } catch (Exception $e) {
            $this->conn->rollback();

            return $e->getMessage();
        }

        return "success";
        
    }

    public function getMemberDashboardStats() {

        $sql = "SELECT COUNT(*) AS total_members,
            SUM(CASE WHEN member_status = 'Active' THEN 1 ELSE 0 END)
            AS active_members,
            SUM(CASE WHEN member_status = 'Inactive' THEN 1 ELSE 0 END)
            AS inactive_members,
            SUM(CASE WHEN MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE()) THEN 1 ELSE 0 END) 
            AS new_members
            FROM member_table";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return [
            "total_members"   => 0,
            "active_members"  => 0,
            "inactive_members"=> 0,
            "new_members"     => 0
        ];
    }

    public function changePassword($user_id,$current,$new) {

        $sql="SELECT login_password FROM login_table WHERE user_id=?";

        $stmt=$this->conn->prepare($sql);

        $stmt->bind_param("i",$user_id);

        $stmt->execute();

        $result=$stmt->get_result();

        $user=$result->fetch_assoc();

        if(!$user){
            return [
                "status"=>"error",
                "message"=>"User not found"
            ];
        }

        if(!password_verify($current,$user['login_password'])){
            return [
                "status"=>"error",
                "message"=>"Current password incorrect"
            ];
        }

        $newPassword=password_hash(
            $new, PASSWORD_DEFAULT
        );

        $sql2="UPDATE login_table SET login_password=? WHERE user_id=?";

        $stmt2=$this->conn->prepare($sql2);

        $stmt2->bind_param("si", $newPassword, $user_id);

        if($stmt2->execute()){
            return [
                "status"=>"success"
            ];
        }

        return [
            "status"=>"error",
            "message"=>"Password update failed"
        ];

    }

}

?>