<?php
session_start();

function move_file($fileTmpPath, $dest_path): string
{
    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        return 'File is successfully uploaded.';
    } else {
        return "There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.  $dest_path";
    }
}

$message = '';
$uploadFileDir = './uploaded_files/';

if (!isset($_POST['uploadBtn']) && !($_POST['uploadBtn'] == 'Upload'))
    return;

if (!isset($_FILES['uploadedFile']) && !($_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)) {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
    $_SESSION['message'] = $message;
    header("developer: index.php");
    return;
}

// get details of the uploaded file
$fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
$fileName = $_FILES['uploadedFile']['name'];
$fileSize = $_FILES['uploadedFile']['size'];
$fileType = $_FILES['uploadedFile']['type'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));

// sanitize file-name
$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

// check if file has one of the following extensions
$allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

if (in_array($fileExtension, $allowedfileExtensions)) {
    // directory in which the uploaded file will be move
    $dest_path = $uploadFileDir . $newFileName;
    $message = move_file($fileTmpPath, $dest_path);
} else {
    $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
}

$_SESSION['message'] = $message;
header("Location: developer.php");
