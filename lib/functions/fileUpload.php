<?php 

/**
 * Class Name: FileUpload
 * Description: Handles file uploads for the Cemetery and Funeral Parlor Management System.
 * 
 * Responsibilities:
 *   - Validate the uploaded file.
 *   - Create the target directory if it doesn't exist.
 *   - Generate a unique filename for the uploaded file.
 *   - Move the uploaded file to the target directory.
 *   - Return the relative path to the uploaded file or null if the upload fails.
 * 
 */
Class FileUpload {

    public static function upload($file, $folder, $allowedTypes = [])
    {
        if (!isset($file) || $file['error'] != UPLOAD_ERR_OK) {
            return false;
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if(!empty($allowedTypes) && !in_array($extension, $allowedTypes)) {
            return false;
        }

        if($file['size'] > 2 * 1024 * 1024) {
            return false;
        }

        $uploadDir = "../../uploads/" . $folder . "/";

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = uniqid($folder . "_", true) . "." . $extension;

        $targetPath = $uploadDir . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            return false;
        }

        return "uploads/" . $folder . "/" . $fileName;
    }
}

?>