<?php 
session_start();
include_once('main.php');

class InvoiceController extends MainController{

    public function getInvoiceDetails($payment_id)
    {

        $sql = "SELECT p.payment_id, p.payment_code, p.payment_date, p.payment_method, p.service_cost, p.memorial_cost, p.total_payment, p.paid_amount,
                    fs.booking_code, fs.service_type
                FROM payment_table p
                INNER JOIN funeral_service_table fs ON p.funeral_service_table_funeral_service_id = fs.funeral_service_id
                WHERE p.payment_id = ?";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            return null;
        }

        $stmt->bind_param("i",$payment_id);

        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

}

?>

