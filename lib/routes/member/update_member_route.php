<?php
include_once("../../functions/memberController.php");

$member = new MemberController();

$imagePath = $_POST['existing_image'] ?? '';

if (!empty($_FILES['image']['name'])) {     

    $allowedExts = ['jpg','jpeg','png','gif','webp'];

    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    if(!in_array($ext,$allowedExts)){
        echo "Invalid image type.";
        exit();
    }

    $fileName = uniqid("mem_img_").".".$ext;

    $uploadPath = "../../uploads/images/".$fileName;

    if(!move_uploaded_file($_FILES['image']['tmp_name'],$uploadPath)){
        echo "Image upload failed.";
        exit();
    }

    $imagePath = "uploads/images/".$fileName;
}

$data = $_POST;
$data['image'] = $imagePath;

$result = $member->updateMember($data);

echo $result;

?>