<?php

$currentDir = getcwd();
$uploadDirectory = "/uploads/";

$errors = []; // Store all foreseen and unforseen errors here

$fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

$fileName = $_FILES['profileImage']['name'];
$fileSize = $_FILES['profileImage']['size'];
$fileTmpName  = $_FILES['profileImage']['tmp_name'];
$fileType = $_FILES['profileImage']['type'];
$tmp = explode('.',$fileName);
$fileExtension = strtolower(end($tmp));

$uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

if (isset($_POST['submit'])) {

    if (! in_array($fileExtension,$fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 2000000) {
        $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
    }

    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
            echo "The file " . basename($fileName) . " has been uploaded";
        } else {
            echo "An error occurred somewhere. Try again or contact the admin";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
}