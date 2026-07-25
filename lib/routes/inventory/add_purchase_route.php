<?php
require_once "../../functions/purchaseController.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "status"  => "error",
        "message" => "Invalid request."
    ]);
    exit;
}

$purchaseController = new PurchaseController();

echo json_encode(
    $purchaseController->addPurchase($_POST)
);

?>