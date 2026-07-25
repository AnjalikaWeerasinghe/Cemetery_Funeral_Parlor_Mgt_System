<?php
session_start();
include_once('main.php');
include_once('numberGeneration.php');

class SupplierController extends MainController {

    public function getNewSupplierCode() {
        $number = new Numbering();
        return $number->generateUniqueNumber("supplier_code", "supplier_table", "CEM-SUP-");   
    }

    public function addNewSupplier($data) {

        if (!$this->conn) {
            die("Database connection is NULL");
        }

        $sqlExistRegNumberEmail = "SELECT supplier_id FROM supplier_table WHERE registration_number = ? OR email = ?";

        $resultExist = $this->conn->prepare($sqlExistRegNumberEmail);

        $resultExist->bind_param("ss", $data['registration_number'], $data['email']);

        $resultExist->execute();

        if ($resultExist->get_result()->num_rows > 0) {
            return "Email or Registration Number already exists";
        }

        $number = new Numbering();
        $supplierCode =  $number->generateUniqueNumber("supplier_code", "supplier_table", "CEM-SUP-");

        $this->conn->begin_transaction();

        try {
            $insertSupplier = "INSERT INTO supplier_table (supplier_name, contact_person, contact_number, email, address, registration_number, supplier_status, supplier_code)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $result = $this->conn->prepare($insertSupplier);

            if (!$result) {
                throw new Exception($this->conn->error);
            }

            $result->bind_param("ssssssss",
                $data['supplier_name'], $data['contact_person'], $data['contact_number'], $data['email'], $data['address'], $data['registration_number'], $data['supplier_status'], $supplierCode
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

    public function view_Supplier_Data($search = "") {
        
        if(!empty($search)) {
            $sqlView = "SELECT * FROM supplier_table 
                WHERE supplier_code LIKE ? OR supplier_name LIKE ? OR  registration_number LIKE ? OR email LIKE ? OR contact_number LIKE ? OR address LIKE ? OR contact_person LIKE ?
                ORDER BY supplier_id DESC";

            $resultView = $this->conn->prepare($sqlView);

            $keyword = "%$search%";

            $resultView->bind_param("sssssss", $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword);

            $resultView->execute();

            $resultView = $resultView->get_result();
        } else {
            $sqlView = "SELECT * FROM supplier_table ORDER BY supplier_id DESC";

            $resultView = $this->conn->query($sqlView);
        }

        if($resultView && $resultView->num_rows > 0){

            while($rec = $resultView->fetch_assoc()){

                echo "<tr>";

                echo "<td><span class='badge bg-light text-dark border px-3 py-2 fw-semibold'>{$rec['supplier_code']}</span></td>";

                echo "<td>
                    <div class='d-flex align-items-center'>
                        <div class='rounded-circle bg-primary text-white d-flex justify-content-center align-items-center fw-bold me-3' style='width:45px;height:45px;font-size:16px;'>
                            ".strtoupper(substr($rec['supplier_name'],0,1))."
                        </div>

                        <div>
                            <div class='fw-semibold'>{$rec['supplier_name']}</div>
                            <small class='text-muted'>{$rec['contact_person']}</small>
                        </div>
                    </div>
                </td>";

                echo "<td><i class='fa-solid fa-envelope text-secondary me-2'></i><span class='text-muted'>{$rec['email']}</span></td>";

                if($rec['supplier_status']=="Active"){
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
                    <button class='btn btn-outline-info btn-sm view' data-id='{$rec['supplier_id']}' data-bs-toggle='tooltip' title='View Supplier'>
                        <i class='fa-solid fa-eye'></i>
                    </button>
                ";

                echo "
                    <button class='btn btn-outline-primary btn-sm edit' data-id='{$rec['supplier_id']}' data-bs-toggle='tooltip' title='Edit Supplier'>
                        <i class='fa-solid fa-pen'></i>
                    </button>
                ";

                if($rec['supplier_status']=="Active"){
                    echo "
                        <button class='btn btn-outline-warning btn-sm supplier-status' data-status='Inactive' data-name='{$rec['supplier_name']}' id='".$rec['supplier_id']."' data-bs-toggle='tooltip' title='Deactivate Supplier'>
                            <i class='fa-solid fa-user-slash'></i>
                        </button>
                    ";
                } else {
                    echo "
                        <button class='btn btn-outline-success btn-sm supplier-status' data-status='Active' data-name='{$rec['supplier_name']}' id='".$rec['supplier_id']."' data-bs-toggle='tooltip' title='Activate Supplier'>
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
                    <h5 class='text-muted'>No Suppliers Found</h5>
                    <small class='text-secondary'>There are currently no registered suppliers.</small>
                </td>
            </tr>";
        }

    }

    public function getSupplierById($id) {

        $sqlGetSupplier = "SELECT * FROM supplier_table WHERE supplier_id = ?";

        $resultSql = $this->conn->prepare($sqlGetSupplier);

        $resultSql->bind_param("i", $id);

        $resultSql->execute();

        $result = $resultSql->get_result()->fetch_assoc();

        if (!$result) {
            return ["error" => "Supplier not found"];
        }

        return $result;
    }

    public function updateSupplier($data) {

        $this->conn->begin_transaction();

        try {
            $sql = "UPDATE supplier_table SET supplier_name = ?, contact_person = ?, contact_number = ?, email = ?, address = ?, registration_number = ?, supplier_status = ?
                WHERE supplier_id = ?";

            $result = $this->conn->prepare($sql);

            $result->bind_param("sssssssi",
                $data['supplier_name'], $data['contact_person'], $data['contact_number'], $data['email'], $data['address'], $data['registration_number'], $data['supplier_status'], $data['supplier_id']
            );

            $result->execute();

            $this->conn->commit();

            return "success";

        } catch (Exception $e) {
            $this->conn->rollback();

            return $e->getMessage();
        }
    }

    public function activateDeactivateSupplier($id, $status) {

        $this->conn->begin_transaction();

        try {

            if($status == "Active"){
                $supplierStatus = "Active";
            }else{
                $supplierStatus = "Inactive";
            }

            $sqlSupplier = "UPDATE supplier_table SET supplier_status = ? WHERE supplier_id = ?";

            $stmt = $this->conn->prepare($sqlSupplier);

            if(!$stmt){
                throw new Exception($this->conn->error);
            }

            $stmt->bind_param("si", $supplierStatus, $id);

            if(!$stmt->execute()){
                throw new Exception($stmt->error);
            }

            $this->conn->commit();

            return "success";

        } catch (Exception $e) {

            $this->conn->rollback();

            return $e->getMessage();
        }
    }

    public function getSupplierDashboardStats() {

        $sql = "SELECT COUNT(*) AS total_suppliers,
            SUM(CASE WHEN supplier_status = 'Active' THEN 1 ELSE 0 END)
            AS active_suppliers,
            SUM(CASE WHEN supplier_status = 'Inactive' THEN 1 ELSE 0 END)
            AS inactive_suppliers,
            SUM(CASE WHEN MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE()) THEN 1 ELSE 0 END) 
            AS new_suppliers
            FROM supplier_table";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return [
            "total_suppliers"   => 0,
            "active_suppliers"  => 0,
            "inactive_suppliers"=> 0,
            "new_suppliers"     => 0
        ];

    }

    public function loadSuppliers() {

        $sql = "SELECT supplier_id, supplier_name 
            FROM supplier_table WHERE supplier_status='Active'
            ORDER BY supplier_name ASC";

        $result = $this->conn->query($sql);

        echo '<option value="">Select Supplier</option>';


            while($row = $result->fetch_assoc()){
                echo '
                <option value="'.$row['supplier_id'].'">
                    '.$row['supplier_name'].'
                </option>';
            }
    }
 
}

?>