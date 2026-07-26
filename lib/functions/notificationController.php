<?php 
include_once('main.php');

class NotificationController extends MainController{

    public function createNotification($sender_id, $receiver_id, $receiver_role, $title, $message, $notification_type, $reference_id = null, $reference_table = null){

        $sql = "INSERT INTO notification_table (sender_id, receiver_id, receiver_role, title, message, notification_type, reference_id, reference_table)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $result = $this->conn->prepare($sql);

        $result->bind_param("iissssis",
            $sender_id, $receiver_id, $receiver_role, $title, $message, $notification_type, $reference_id, $reference_table);

        return $result->execute();
    }

    public function getNotifications($receiver_id, $receiver_role){

        $sql = "SELECT * FROM notification_table WHERE receiver_id = ? AND receiver_role = ?
            ORDER BY created_at DESC LIMIT 5";

        $result = $this->conn->prepare($sql);

        $result->bind_param("is", $receiver_id, $receiver_role);

        $result->execute();

        return $result->get_result();
    }

    public function getUnreadNotificationCount($receiver_id, $receiver_role){

        $sql = "SELECT COUNT(*) total FROM notification_table WHERE receiver_id = ? AND receiver_role = ?
            AND is_read = 0";

        $result = $this->conn->prepare($sql);

        $result->bind_param("is", $receiver_id, $receiver_role);

        $result->execute();

        return $result->get_result()->fetch_assoc()['total'];
    }

    public function markAsRead($id){

        $sql = "UPDATE notification_table SET is_read = 1 WHERE notification_id = ?";

        $result = $this->conn->prepare($sql);

        $result->bind_param("i", $id);

        return $result->execute();
    }

    public function getNotificationById($notification_id){

        $sql = "SELECT n.*, fs.booking_code
                FROM notification_table n
                LEFT JOIN funeral_service_table fs
                ON n.reference_id = fs.funeral_service_id
                WHERE n.notification_id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $notification_id);

        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }
    
}

?>