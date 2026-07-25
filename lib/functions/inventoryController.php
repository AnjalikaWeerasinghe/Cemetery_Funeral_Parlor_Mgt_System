<?php
session_start();
include_once('main.php');

class InventoryController extends MainController {

    public function addInventory($data) {

        $sql = "INSERT INTO inventory_item_table (current_quantity, reorder_level, inventory_status, item_table_item_id)
                VALUES (?,?,?,?)";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            die($this->conn->error);
        }

        $stmt->bind_param("iisi",
            $data['quantity'],  $data['reorder_level'], $data['status'], $data['item_id']
        );

        return $stmt->execute();
    }

    public function viewInventory() {

        $sql = "SELECT inv.inventory_id, inv.current_quantity, inv.reorder_level, inv.inventory_status, i.item_code, i.item_name, i.unit
                FROM inventory_item_table inv
                INNER JOIN item_table i ON inv.item_table_item_id = i.item_id
                ORDER BY inv.inventory_id DESC";

        $result = $this->conn->query($sql);

        if($result->num_rows > 0){

            while($row = $result->fetch_assoc()){

                if($row['current_quantity'] <= $row['reorder_level']){
                    $stockStatus = "<span class='badge bg-danger'>Low Stock</span>";
                }else{
                    $stockStatus = "<span class='badge bg-success'>Available</span>";
                }

                echo "<tr>
                    <td>
                        <span class='badge bg-light text-dark border px-3 py-2'>
                            {$row['item_code']}
                        </span>
                    </td>

                    <td>
                        {$row['item_name']}
                    </td>

                    <td>
                        {$row['unit']}
                    </td>

                    <td>
                        {$row['current_quantity']}
                    </td>

                    <td>
                        {$stockStatus}
                    </td>

                    <td class='text-center'>
                        <button class='btn btn-sm btn-outline-primary rounded-circle editInventory' data-id='{$row['inventory_id']}' title='Edit Inventory' style='width:38px;height:38px;'>
                            <i class='fa fa-edit'></i>
                        </button>

                        <button class='btn btn-sm btn-outline-danger rounded-circle deleteInventory' data-id='{$row['inventory_id']}' title='Delete Inventory' style='width:38px;height:38px;'>
                            <i class='fa fa-trash'></i>
                        </button>
                    </td>
                </tr>";

            }

        }else{
            echo "
            <tr>
                <td colspan='7' class='text-center'>
                    No Inventory Records Found
                </td>
            </tr>";
        }
    }

}

?>