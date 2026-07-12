<?php
include_once('../../functions/empController.php');

$staff = new EmpController();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {    
    echo "Invalid request method.";
    exit();
}

function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$requiredFields = [
    'first_name', 'last_name', 'nic', 'email', 'password_hash', 'system_role'
];

foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        echo "All required fields must be filled.";
        exit();
    }
}

//Image Upload
$imagePath = '';

if (!empty($_FILES['image']['name'])) {

    $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $originalName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $imageExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($imageExt, $allowedExts)) {
        echo "Invalid image file type.";
        exit();
    }

    $fileName = uniqid('stf_img') . '.' . $imageExt;

    $uploadPath = '../../uploads/images/' . $fileName;

    $imagePath = 'uploads/images/' . $fileName;

    if (!move_uploaded_file($tmpName, $uploadPath)) {
        echo "Image upload failed.";
        exit();
    }
}

// Sanitize input data
$data = [
    'first_name' => sanitize_input($_POST['first_name']),
    'middle_name' => sanitize_input($_POST['middle_name'] ?? ''),
    'last_name' => sanitize_input($_POST['last_name']),
    'nic' => sanitize_input($_POST['nic']),
    'gender' => !empty($_POST['gender']) ? sanitize_input($_POST['gender']) : null,
    'date_of_birth' => !empty($_POST['date_of_birth']) ? sanitize_input($_POST['date_of_birth']) : null,
    'contact_number' => sanitize_input($_POST['contact_number'] ?? ''),
    'address' => sanitize_input($_POST['address'] ?? ''),
    'role_id' => !empty($_POST['role_id']) ? (int)$_POST['role_id'] : null,
    'employement_type' => sanitize_input($_POST['employement_type'] ?? ''),
    'date_joined' => !empty($_POST['date_joined']) ? $_POST['date_joined'] : null,
    'staff_status' => sanitize_input($_POST['staff_status'] ?? ''),
    'salary' => !empty($_POST['salary']) ? $_POST['salary'] : 0,
    'email' => sanitize_input($_POST['email']),
    'password_hash' => !empty($_POST['password_hash']) ? $_POST['password_hash'] : null,
    'image' => $imagePath,
    'system_role' => sanitize_input($_POST['system_role'])
];

$result = $staff->insert_staff($data);

echo $result;

?>