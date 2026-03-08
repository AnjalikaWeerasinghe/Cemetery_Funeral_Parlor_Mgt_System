<?php
include_once('../../functions/roleController.php');

$role = new RoleController();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {    
    echo "Invalid request method.";
    exit();
}

function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$requiredFields = ['name'];

foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        echo "All required fields must be filled.";
        exit();
    }
}

$data = [
    'name' => sanitize_input($_POST['name']),
    'description' => sanitize_input($_POST['description']),
    'permission' => sanitize_input($_POST['permission'])
];

$result = $role->insert_role($data);

echo $result;

?>