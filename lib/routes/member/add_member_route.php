<?php 
include_once('../../functions/memberController.php');

$member = new MemberController();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {    
    echo "Invalid request method.";
    exit();
}

function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$requiredFields = [
    'first_name', 'last_name', 'nic', 'email', 'password_hash'
];

foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        echo "All required fields must be filled.";
        exit();
    }
}

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

    $fileName = uniqid('mem_img') . '.' . $imageExt;

    $uploadPath = '../../uploads/images/' . $fileName;

    $imagePath = 'uploads/images/' . $fileName;

    if (!move_uploaded_file($tmpName, $uploadPath)) {
        echo "Image upload failed.";
        exit();
    }
}

$data = [
    'first_name' => sanitize_input($_POST['first_name']),
    'middle_name' => sanitize_input($_POST['middle_name'] ?? ''),
    'last_name' => sanitize_input($_POST['last_name']),
    'nic' => sanitize_input($_POST['nic']),
    'gender' => !empty($_POST['gender']) ? $_POST['gender'] : null,
    'date_of_birth' => !empty($_POST['date_of_birth']) ? $_POST['date_of_birth'] : null,
    'contact_number' => sanitize_input($_POST['contact_number'] ?? ''),
    'address' => sanitize_input($_POST['address'] ?? ''),
    'email' => sanitize_input($_POST['email']),
    'password_hash' => sanitize_input($_POST['password_hash']),
    'member_status' => sanitize_input($_POST['member_status'] ?? ''),
    'image' => $imagePath
];

$result = $member->addNewMember($data);

echo $result;

?>