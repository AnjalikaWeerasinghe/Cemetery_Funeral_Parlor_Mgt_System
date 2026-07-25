<?php
session_start();
include_once('main.php');

class SupplierItemController extends MainController {

    public function addSupplierItem($data) {

        $supplier_id = $data['supplier_id'];
        $item_id     = $data['item_id'];
        $unit_price  = $data['unit_price'];

        if(empty($supplier_id) || empty($item_id) || empty($unit_price)){
            return [
                "status"=>"error",
                "message"=>"Please fill all required fields"
            ];
        }

        $check = "SELECT supplier_item_id FROM supplier_item_table WHERE supplier_table_supplier_id=? AND item_table_item_id=?";

        $stmt = $this->conn->prepare($check);

        $stmt->bind_param("ii", $supplier_id, $item_id);

        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            return [
                "status"=>"error",
                "message"=>"This item already exists for this supplier"
            ];
        }

        $sql = "INSERT INTO supplier_item_table (supplier_table_supplier_id, item_table_item_id, unit_price)
            VALUES (?,?,?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("iid", $supplier_id, $item_id, $unit_price);

        if($stmt->execute()) {
            return [
                "status"=>"success",
                "message"=>"Supplier item added successfully"
            ];
        } else {
            return [
                "status"=>"error",
                "message"=>"Failed to add supplier item"
            ];
        }
    }

    public function viewSupplierItems() {

        $sql = "SELECT si.supplier_item_id, s.supplier_name, i.item_name, i.unit, si.unit_price
            FROM supplier_item_table si
            INNER JOIN supplier_table s ON si.supplier_table_supplier_id = s.supplier_id
            INNER JOIN item_table i ON si.item_table_item_id = i.item_id
            ORDER BY si.supplier_item_id DESC";

        $result = $this->conn->query($sql);

        $count = 1;

        if($result->num_rows > 0){
            
            while($row = $result->fetch_assoc()) {

                echo "
                <tr>
                    <td>
                        <div class='d-flex align-items-center'>
                            <div class='supplier-icon me-2'><i class='fa fa-building'></i></div>

                            <span class='fw-semibold'>{$row['supplier_name']}</span>
                        </div>
                    </td>

                    <td>
                        <span class='badge bg-light text-dark border px-3 py-2'>
                            <i class='fa fa-box me-1 text-secondary'></i>{$row['item_name']}
                        </span>
                    </td>

                    <td>
                        <span class='badge bg-info-subtle text-info px-3 py-2'>{$row['unit']}</span>
                    </td>

                    <td>
                        <span class='fw-bold text-success'>
                            Rs. ".number_format($row['unit_price'],2)."
                        </span>
                    </td>

                    <td>
                        <button class='btn btn-sm btn-outline-primary rounded-circle edit' data-id='{$row['supplier_item_id']}' data-bs-toggle='tooltip' title='Edit Supplier Item' style='width:38px;height:38px;'>
                            <i class='fa fa-edit'></i>
                        </button>

                        <button class='btn btn-sm btn-outline-danger rounded-circle delete' data-id='{$row['supplier_item_id']}' data-bs-toggle='tooltip' title='Delete Supplier Item' style='width:38px;height:38px;'>
                            <i class='fa fa-trash'></i>
                        </button>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr>
                    <td colspan='6' class='text-center'>
                        No Supplier Items Found
                    </td>
                </tr>";
        }

    }

}