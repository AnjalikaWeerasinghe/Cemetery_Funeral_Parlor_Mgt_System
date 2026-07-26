<?php
session_start();
include_once('main.php');

class PaymentController extends MainController {

    public function loadMyPayments($member_id) {

        $user_id = $_SESSION['user_id'];

        $sqlId = "SELECT member_id FROM member_table WHERE login_table_user_id = ?";

        $stmt = $this->conn->prepare($sqlId);
        $stmt->bind_param("i",$user_id);
        $stmt->execute();

        $memberResult = $stmt->get_result();

        if($memberResult->num_rows == 0){
            return [];
        }

        $member = $memberResult->fetch_assoc();

        $member_id = $member['member_id'];

        $sql = "SELECT p.payment_code, fs.booking_code, fs.service_type, p.total_payment, p.payment_status, p.payment_date
            FROM payment_table p
            INNER JOIN funeral_service_table fs ON p.funeral_service_table_funeral_service_id = fs.funeral_service_id
            INNER JOIN applicant_table a ON fs.applicant_table_applicant_id = a.applicant_id
            WHERE a.member_table_member_id1 = ?
            ORDER BY p.payment_id DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i",$member_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $output="";

        if($result->num_rows > 0){

            while($row=$result->fetch_assoc()){

                $output .= "
                    <tr>
                        <td>{$row['payment_code']}</td>

                        <td>{$row['booking_code']}</td>

                        <td>{$row['service_type']}</td>

                        <td>Rs. ".number_format($row['total_payment'],2)."</td>

                        <td>
                            <span class='badge bg-success'>{$row['payment_status']}</span>
                        </td>

                        <td>{$row['payment_date']}</td>

                    </tr>

                ";
            }

        }else{
            $output .= "
                <tr>
                    <td colspan='6' class='text-center'>No Payment Records Found</td>
                </tr>

            ";
        }
        return $output;
    }

}

?>