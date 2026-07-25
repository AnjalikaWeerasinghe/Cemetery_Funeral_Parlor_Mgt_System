<?php
require_once("../../functions/itemController.php");

$item = new ItemController();

echo $item->getNewItemCode();
?>