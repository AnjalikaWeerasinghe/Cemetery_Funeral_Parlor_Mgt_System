<?php
include_once("../../functions/itemController.php");

header('Content-Type: application/json');

if (!isset($_GET['item_id']) || empty($_GET['item_id'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Item ID is required."
    ]);
    exit;
}

$itemController = new ItemController();

$item = $itemController->getItemUnits($_GET['item_id']);

if ($item) {
    echo json_encode([
        "unit" => $item['unit'],
        "unit_price" => $item['unit_price']
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Item not found."
    ]);
}

?>