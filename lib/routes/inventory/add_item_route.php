<?php 
include_once('../../functions/itemController.php');

$item = new ItemController();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {    
    echo "Invalid request method.";
    exit();
}

function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$requiredFields = [
    'item_name', 'item_status', 'unit'
];

foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        echo "All required fields must be filled.";
        exit();
    }
}

$data = [
    'item_name' => sanitize_input($_POST['item_name']),
    'item_status' => sanitize_input($_POST['item_status']),
    'unit' => sanitize_input($_POST['unit']),
    'item_code' => sanitize_input($_POST['item_code']),
    'description' => sanitize_input($_POST['description'])
];

$result = $item->addNewItem($data);

echo $result;

?>