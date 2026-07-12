<?php
include_once('../../functions/notificationController.php');

$id = $_GET['id'];

$notification = new NotificationController();

$notification->markAsRead($id);

header("Location: ../../views/admin.php?page=notifications");

exit;

?>