<?php
include_once('../../functions/notificationController.php');

if(!isset($_GET['id'])){
    die("Notification ID missing.");
}

$notificationId = $_GET['id'];

$notificationObj = new NotificationController();

$notificationObj->markAsRead($notificationId);

$notification = $notificationObj->getNotificationById($notificationId);

if(!$notification){
    die("Notification not found.");
}

switch($notification['notification_type']){

    case "Cremation":
    case "Burial":
        header("Location: ../../views/admin.php?page=view_funeral_booking&booking_code=" . urlencode($notification['booking_code']));
        break;

    default:
        header("Location: ../../views/admin.php?page=dashboard");
        break;
}
exit;

?>