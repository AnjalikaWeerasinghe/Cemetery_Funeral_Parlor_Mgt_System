<?php
include_once('../../functions/itemController.php');

$itemViewObj = new ItemController();

$search = $_GET['search'] ?? '';

echo $itemViewObj->view_Item_Data($search);

?>