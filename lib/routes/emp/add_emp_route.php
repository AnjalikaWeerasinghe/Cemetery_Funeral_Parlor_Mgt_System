<?php
include_once('../../functions/userFunction.php');

$user = new UserController();

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$imageName = $_FILES['image_sample']['name'] ?? '';
$imageTmpName = $_FILES['image_sample']['tmp_name'] ?? '';
$imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
$allowedExts = array('jpg', 'jpeg', 'png', 'gif');
if(!in_array($imageExt, $allowedExts) && $imageName != ''){
    echo ("Invalid image file type.");
    exit();
}
$path = '../../uploads/images/';
$customImageName = uniqid('img_') . '.' . $imageExt;
$imageName = $customImageName;
if($imageName != ''){
    move_uploaded_file($imageTmpName, $path . $imageName);
}
// Sanitize input data
$email = sanitize_input($_POST['exampleInputEmail1'] ?? '');
$password = sanitize_input($_POST['exampleInputPassword1'] ?? '');
$role = sanitize_input($_POST['exampleSelect1'] ?? '');

if(empty($_POST['exampleInputEmail1']) || empty($_POST['exampleInputPassword1']) || empty($_POST['exampleSelect1'])){
    echo ("All fields are required!");
    exit();
}
else{
$result = $user->insert_user($email,$password,$role);
echo($result);
}





?>