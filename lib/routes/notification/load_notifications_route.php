<?php
include_once(__DIR__ . "/../../functions/notificationController.php");

$notificationObj = new NotificationController();

$notifications = [];
$notificationCount = 0;

if(isset($_SESSION['user_id']) && isset($_SESSION['role'])){

    $result = $notificationObj->getNotifications(
        $_SESSION['user_id'],
        $_SESSION['role']
    );

    while($row = $result->fetch_assoc()){
        $notifications[] = $row;
    }

    $notificationCount = $notificationObj->getUnreadNotificationCount(
        $_SESSION['user_id'],
        $_SESSION['role']
    );
}

?>