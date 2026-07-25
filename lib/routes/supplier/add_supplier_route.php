<?php 
include_once('../../functions/supplierController.php');

$supplier = new SupplierController();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {    
    echo "Invalid request method.";
    exit();
}

function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$requiredFields = [
    'supplier_name', 'contact_person', 'contact_number', 'email', 'address', 'registration_number'
];

foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        echo "All required fields must be filled.";
        exit();
    }
}

$data = [
    'supplier_name' => sanitize_input($_POST['supplier_name']),
    'contact_person' => sanitize_input($_POST['contact_person']),
    'contact_number' => sanitize_input($_POST['contact_number']),
    'address' => sanitize_input($_POST['address'] ?? ''),
    'email' => sanitize_input($_POST['email']),
    'registration_number' => sanitize_input($_POST['registration_number']),
    'supplier_status' => sanitize_input($_POST['supplier_status'] ?? '')
];

$result = $supplier->addNewSupplier($data);

echo $result;

?>