<?php
session_start();
include_once('main.php');
include_once('numberGeneration.php');

class PurchaseController extends MainController {

    public function getNewPurchaseCode(){
        $number = new Numbering();
        return $number->generateUniqueNumber("purchase_code", "supplier_purchase_table", "CEM-PK-");   
    }

    public function loadSupplierItems() {

        if(!isset($_GET['supplier_id'])){
            echo json_encode([]);
            return;
        }

        $supplier_id = $_GET['supplier_id'];

        $sql = "SELECT si.supplier_item_id, i.item_id, i.item_name, i.unit, si.unit_price
            FROM supplier_item_table si
            INNER JOIN item_table i ON si.item_table_item_id = i.item_id
            WHERE si.supplier_table_supplier_id = ?
            ORDER BY i.item_name ASC";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $supplier_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $items = [];

        while($row = $result->fetch_assoc()){
            $items[] = $row;
        }

        echo json_encode($items);

    }

    public function addPurchase($data) {

        if (empty($data['supplier_id']) || empty($data['purchase_date'])) {
            return [
                "status" => "error",
                "message" => "Please fill all required fields."
            ];
        }

        if (!isset($data['supplier_item_id']) || count($data['supplier_item_id']) == 0) {
            return [
                "status" => "error",
                "message" => "Please add at least one purchase item."
            ];
        }

        $number = new Numbering();
        $purchaseCode = $number->generateUniqueNumber("purchase_code", "supplier_purchase_table", "CEM-PK-"); 

        $supplierId    = $data['supplier_id'];
        $purchaseDate  = $data['purchase_date'];
        $paymentStatus = $data['payment_status'];
        $remarks       = trim($data['remarks']);

        $supplierItems = $data['supplier_item_id'];
        $quantities    = $data['quantity'];
        $unitPrices    = $data['unit_price'];
        $subTotals     = $data['sub_total'];

        $grandTotal = array_sum($subTotals);

        $this->conn->begin_transaction();

        try {

            $sql = "INSERT INTO supplier_purchase_table (purchase_code, purchase_date, total_amount, payment_status, remarks, supplier_table_supplier_id)
                VALUES (?,?,?,?,?,?)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param("ssdssi",
                $purchaseCode, $purchaseDate, $grandTotal, $paymentStatus, $remarks, $supplierId
            );

            if (!$stmt->execute()) {
                throw new Exception($stmt->error);
            }

            $purchaseId = $this->conn->insert_id;

            $detailSql = "INSERT INTO purchase_detail_table (quantity, unit_price, sub_total, supplier_item_table_supplier_item_id, supplier_purchase_table_purchase_id)
                VALUES (?,?,?,?,?)";

            $detailStmt = $this->conn->prepare($detailSql);

            for ($i = 0; $i < count($supplierItems); $i++) {

                $supplierItemId = $supplierItems[$i];
                $qty            = $quantities[$i];
                $price          = $unitPrices[$i];
                $subTotal       = $subTotals[$i];

                $detailStmt->bind_param("iddii",
                    $qty, $price, $subTotal, $supplierItemId, $purchaseId
                );

                if (!$detailStmt->execute()) {
                    throw new Exception($detailStmt->error);
                }
            }

            $this->conn->commit();

            return [
                "status" => "success",
                "message" => "Purchase Order created successfully."
            ];

        } catch (Exception $e) {
            $this->conn->rollback();

            return [
                "status" => "error",
                "message" => $e->getMessage()
            ];
        }

    }

    public function viewPurchases() {

        $sql = "SELECT p.purchase_id,p.purchase_code, p.purchase_date, p.total_amount, p.payment_status, s.supplier_name
            FROM supplier_purchase_table p
            INNER JOIN supplier_table s ON p.supplier_table_supplier_id = s.supplier_id
            ORDER BY p.purchase_id DESC";

        $result = $this->conn->query($sql);

        $count = 1;

        if($result->num_rows > 0){
            
            while($row = $result->fetch_assoc()) {

                echo "
                <tr>
                    <td>
                        <span class='badge bg-light text-dark border px-3 py-2 fw-semibold'>
                            {$row['purchase_code']}
                        </span>
                    </td>

                    <td>
                        <i class='fa fa-truck text-secondary me-2'></i>{$row['supplier_name']}
                    </td>

                    <td>
                        <i class='fa fa-calendar text-secondary me-2'></i>{$row['purchase_date']}
                    </td>

                    <td>
                        <span class='fw-bold text-success'>
                            Rs. ".number_format($row['total_amount'],2)."
                        </span>
                    </td>

                    <td>";
                        if($row['payment_status']=="Paid"){
                            echo "
                            <span class='badge bg-success px-3 py-2'>
                                <i class='fa fa-check-circle me-1'></i>Paid
                            </span>";
                        }else{
                            echo "
                            <span class='badge bg-warning text-dark px-3 py-2'>
                                <i class='fa fa-clock me-1'></i>Pending
                            </span>";
                        }
                    echo "</td>

                    <td>
                        <button class='btn btn-sm btn-outline-secondary rounded-circle view' data-id='{$row['purchase_id']}' data-bs-toggle='tooltip' title='View Purchase' style='width:38px;height:38px;'>
                            <i class='fa fa-eye'></i>
                        </button>

                        <button class='btn btn-sm btn-outline-primary rounded-circle edit' data-id='{$row['purchase_id']}' data-bs-toggle='tooltip' title='Edit Purchase' style='width:38px;height:38px;'>
                            <i class='fa fa-edit'></i>
                        </button>

                        <button class='btn btn-sm btn-outline-danger rounded-circle delete' data-id='{$row['purchase_id']}' data-bs-toggle='tooltip' title='Delete Purchase' style='width:38px;height:38px;'>
                            <i class='fa fa-trash'></i>
                        </button>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr>
                    <td colspan='6' class='text-center'>
                        No Purchase Records Found
                    </td>
                </tr>";
        }

    }

}

?>