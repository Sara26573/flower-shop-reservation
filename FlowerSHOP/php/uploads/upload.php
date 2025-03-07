<?php
// Set the target directory to upload the file
$targetDir = __DIR__ . "/uploads/";


// Check if a file is uploaded and handle it
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["fileToUpload"])) {
        $fileName = $_FILES["fileToUpload"]["name"];
        $fileTmpName = $_FILES["fileToUpload"]["tmp_name"];
        $fileSize = $_FILES["fileToUpload"]["size"];
        $fileError = $_FILES["fileToUpload"]["error"];
        $fileType = $_FILES["fileToUpload"]["type"];
        
        // Define the target path where the file will be stored
        $targetFile = $targetDir. "/" .basename($fileName);
        
        // Check for upload errors
        if ($fileError === UPLOAD_ERR_OK) {
            // You can add additional checks for file type or size if necessary
            if ($fileSize < 5000000) { // Limit to 5MB
                // Check if file was successfully uploaded to the temp directory
                if (is_uploaded_file($fileTmpName)) {
                    if (move_uploaded_file($fileTmpName, $targetFile)) {
                        echo "The file " . htmlspecialchars($fileName) . " has been uploaded successfully.";
                    } else {
                        echo "Error moving the uploaded file. Check directory permissions.";
                    }
                } else {
                    echo "File is not a valid upload. Possible PHP configuration issue.";
                }
            } else {
                echo "Sorry, your file is too large. Maximum size is 5MB.";
            }
        } else {
            echo "Error with file upload. Error code: " . $fileError;
            // This will display more specific error codes:
            // 1: UPLOAD_ERR_INI_SIZE
            // 2: UPLOAD_ERR_FORM_SIZE
            // 3: UPLOAD_ERR_PARTIAL
            // 4: UPLOAD_ERR_NO_FILE
            // 6: UPLOAD_ERR_NO_TMP_DIR
            // 7: UPLOAD_ERR_CANT_WRITE
            // 8: UPLOAD_ERR_EXTENSION
        }
    } else {
        echo "No file was uploaded.";
    }
}
?>
