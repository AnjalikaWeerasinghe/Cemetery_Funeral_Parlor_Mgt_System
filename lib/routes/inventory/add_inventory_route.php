<?php
include_once("../../functions/inventoryController.php");

header('Content-Type: application/json');

if(!isset($_POST['item_id']) || !isset($_POST['quantity'])){
    echo json_encode([
        "status"=>"error",
        "message"=>"Required fields missing."
    ]);
    exit;
}

$inventoryController = new InventoryController();

$data = [
    "item_id"        => $_POST['item_id'],
    "quantity"       => $_POST['quantity'],
    "reorder_level"  => $_POST['reorder_level'] ?? 5,
    "status"         => $_POST['status'] ?? "Available"
];

$result = $inventoryController->addInventory($data);

if($result){
    echo json_encode([
        "status"=>"success",
        "message"=>"Inventory added successfully."
    ]);
} else {
    echo json_encode([
        "status"=>"error",
        "message"=>"Failed to add inventory."
    ]);
}

?>