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

// Function to sanitize input
// function sanitize_input($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }

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
$imageName = '';

if (!empty($_FILES['image_sample']['name'])) {

    $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
    $originalName = $_FILES['image_sample']['name'];
    $tmpName = $_FILES['image_sample']['tmp_name'];
    $imageExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($imageExt, $allowedExts)) {
        echo "Invalid image file type.";
        exit();
    }

    $imageName = uniqid('img_') . '.' . $imageExt;
    $uploadPath = '../../uploads/images/' . $imageName;

    if (!move_uploaded_file($tmpName, $uploadPath)) {
        echo "Image upload failed.";
        exit();
    }
}

// $imageName = $_FILES['image_sample']['name'] ?? '';
// $imageTmpName = $_FILES['image_sample']['tmp_name'] ?? '';
// $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
// $allowedExts = array('jpg', 'jpeg', 'png', 'gif');
// if(!in_array($imageExt, $allowedExts) && $imageName != ''){
//     echo ("Invalid image file type.");
//     exit();
// }
// $path = '../../uploads/images/';
// $customImageName = uniqid('img_') . '.' . $imageExt;
// $imageName = $customImageName;
// if($imageName != ''){
//     move_uploaded_file($imageTmpName, $path . $imageName);
// }

// Sanitize input data
$data = [
    // 'staff_code' => $staff_code,
    'first_name' => sanitize_input($_POST['first_name']),
    'middle_name' => sanitize_input($_POST['middle_name'] ?? ''),
    'last_name' => sanitize_input($_POST['last_name']),
    'nic' => sanitize_input($_POST['nic']),
    'gender' => sanitize_input($_POST['gender'] ?? ''),
    'date_of_birth' => sanitize_input($_POST['date_of_birth'] ?? ''),
    'contact_number' => sanitize_input($_POST['contact_number'] ?? ''),
    'address' => sanitize_input($_POST['address'] ?? ''),
    'role_id' => sanitize_input($_POST['role_id'] ?? ''),
    'employement_type' => sanitize_input($_POST['employement_type'] ?? ''),
    'date_joined' => sanitize_input($_POST['date_joined'] ?? ''),
    'staff_status' => sanitize_input($_POST['staff_status'] ?? ''),
    'salary' => sanitize_input($_POST['salary'] ?? ''),
    'email' => sanitize_input($_POST['email']),
    'password_hash' => sanitize_input($_POST['password_hash']),
    'image' => $imageName,
    'system_role' => sanitize_input($_POST['system_role'])
];


// $email = sanitize_input($_POST['exampleInputEmail1'] ?? '');
// $password = sanitize_input($_POST['exampleInputPassword1'] ?? '');
// $role = sanitize_input($_POST['exampleSelect1'] ?? '');

// if(empty($_POST['exampleInputEmail1']) || empty($_POST['exampleInputPassword1']) || empty($_POST['exampleSelect1'])){
//     echo ("All fields are required!");
//     exit();
// }
// else{
// $result = $user->insert_user($email,$password,$role);
// echo($result);
// }

$result = $staff->insert_staff($data);

echo $result;

?>