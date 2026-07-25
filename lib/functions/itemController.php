<?php
session_start();
include_once('main.php');
include_once('numberGeneration.php');

class ItemController extends MainController {

    public function getNewItemCode() {
        $number = new Numbering();
        return $number->generateUniqueNumber("item_code", "item_table", "CEM-ITM-");   
    }

    public function addNewItem($data) {

        if (!$this->conn) {
            die("Database connection is NULL");
        }

        $number = new Numbering();
        $itemCode = $number->generateUniqueNumber("item_code", "item_table", "CEM-ITM-"); 
        
        $this->conn->begin_transaction();

        try {
            $insertItem = "INSERT INTO item_table (item_name, item_code, item_status, unit, description)
                VALUES (?, ?, ?, ?, ?)";

            $result = $this->conn->prepare($insertItem);

            if (!$result) {
                throw new Exception($this->conn->error);
            }

            $result->bind_param("sssss",
                $data['item_name'], $itemCode, $data['item_status'], $data['unit'], $data['description']
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

    public function view_Item_Data($search = "") {

        if(!empty($search)) {
            $sqlView = "SELECT *FROM item_table 
                WHERE item_code LIKE ? OR item_name LIKE ? OR unit LIKE ?
                ORDER BY item_id DESC";

            $resultView = $this->conn->prepare($sqlView);

            $keyword = "%$search%";

            $resultView->bind_param("sss", $keyword, $keyword, $keyword);

            $resultView->execute();

            $resultView = $resultView->get_result();
        } else {
            $sqlView = "SELECT * FROM item_table ORDER BY item_id DESC";

            $resultView = $this->conn->query($sqlView);
        }

        if($resultView && $resultView->num_rows > 0){

            while($rec = $resultView->fetch_assoc()){

                echo "<tr>";

                echo "<td>
                        <span class='badge bg-light text-dark border px-3 py-2 fw-semibold'>
                            {$rec['item_code']}
                        </span>
                    </td>";

                echo "<td>
                        <div class='d-flex align-items-center'>
                            <div class='rounded-circle bg-warning text-dark d-flex justify-content-center align-items-center fw-bold me-3' style='width:45px;height:45px;font-size:18px;'>
                                ".strtoupper(substr($rec['item_name'],0,1))."
                            </div>

                            <div>
                                <div class='fw-semibold'>{$rec['item_name']}</div>
                                <small class='text-muted'>Inventory Item</small>
                            </div>
                        </div>
                    </td>";

                echo "<td>
                        <span class='badge bg-info-subtle text-info border px-3 py-2'>
                            <i class='fa-solid fa-ruler me-1'></i>{$rec['unit']}
                        </span>
                    </td>";

                echo "<td>
                        <i class='fa-solid fa-box-open text-secondary me-2'></i>
                        <span class='text-muted'>"
                            .(!empty($rec['description']) ? $rec['description'] : 'No description')."
                        </span>
                    </td>";

                if($rec['item_status']=="Available"){
                    echo "<td>
                            <span class='badge rounded-pill bg-success text-white px-3 py-2'>
                                <i class='fa-solid fa-circle-check me-1'></i>Available
                            </span>
                        </td>";
                }else{
                    echo "<td>
                            <span class='badge rounded-pill bg-danger text-white px-3 py-2'>
                                <i class='fa-solid fa-circle-xmark me-1'></i>Unavailable
                            </span>
                        </td>";
                }

                echo "<td>
                        <div class='d-flex justify-content-center gap-2'>
                            <button class='btn btn-sm btn-outline-primary rounded-circle edit' data-id='{$rec['item_id']}' data-bs-toggle='tooltip' title='Edit Item' style='width:38px;height:38px;'>
                                <i class='fa-solid fa-pen'></i>
                            </button>

                            <button class='btn btn-sm btn-outline-danger rounded-circle delete' data-id='{$rec['item_id']}' data-bs-toggle='tooltip' title='Delete Item' style='width:38px;height:38px;'>
                                <i class='fa-solid fa-trash'></i>
                            </button>
                        </div>
                    </td>";

                echo "</tr>";
            } 
            
        } else {
            echo "<tr>
                <td colspan='5' class='text-center py-5'>
                    <i class='fa-solid fa-users fa-3x text-secondary mb-3'></i>
                    <h5 class='text-muted'>No Items Found</h5>
                    <small class='text-secondary'>There are currently no item.</small>
                </td>
            </tr>";
        }
    }

    public function loadItems() {

        $sql = "SELECT item_id, item_name 
            FROM item_table WHERE item_status='Available'
            ORDER BY item_name ASC";

        $result = $this->conn->query($sql);

        echo '<option value="">Select Item</option>';


            while($row = $result->fetch_assoc()){
                echo '
                <option value="'.$row['item_id'].'">
                    '.$row['item_name'].'
                </option>';
            }
    }

    public function getItemUnits($item_id) {

        $sql = "SELECT i.unit, si.unit_price
            FROM item_table i
            LEFT JOIN supplier_item_table si ON i.item_id = si.item_table_item_id
            WHERE i.item_id = ?
            LIMIT 1";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            die("SQL Error: ".$this->conn->error);
        }

        $stmt->bind_param("i",$item_id);

        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        return null;
        
    }

}

?>