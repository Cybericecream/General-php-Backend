<?php

include($_SERVER['DOCUMENT_ROOT'] . 'includes/database.php');

// $currentDir = getcwd();
// $uploadDirectory = "/uploads/";

// $errors = []; // Store all foreseen and unforseen errors here

// $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

// $fileName = $_FILES['profileImage']['name'];
// $fileSize = $_FILES['profileImage']['size'];
// $fileTmpName  = $_FILES['profileImage']['tmp_name'];
// $fileType = $_FILES['profileImage']['type'];
// $tmp = explode('.',$fileName);
// $fileExtension = strtolower(end($tmp));

// $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

if (isset($_POST['submit'])) {

        //collect form data
        extract($_POST);

        //very basic validation
        if($username ==''){
            $error[] = 'Please enter the username.';
        }
        if($firstName ==''){
            $error[] = 'Please enter the First Name.';
        }
        if($lastName ==''){
            $error[] = 'Please enter the Last Name.';
        }
        if($password ==''){
            $error[] = 'Please enter the Password.';
        }

        $username = htmlspecialchars($username);
    
        $firstName = htmlspecialchars($firstName);
    
        $lastName = htmlspecialchars($lastName);

        $password = htmlspecialchars(password_hash($password, PASSWORD_DEFAULT));

        $img = 1;

        $admin = 0;
    
        if(!isset($error)){
    
            try {
    
                //insert into database
                $stmt = $db->prepare('INSERT INTO user (username,first,last,password,image,admin) VALUES (:username,:first,:last,:password,:image,:admin)') ;
                $stmt->execute(array(
                    ':username' => $username,
                    ':first' => $firstName,
                    ':last' => $lastName,
                    ':password' => $password,
                    ':image' => $img,
                    ':admin' => $admin
                ));
    
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

            $userId = $db->lastInsertId();

            // try {

            //     //insert into database
            //     $stmt = $db->prepare('INSERT INTO userImage (fileName,fileSize,fileType,userId) VALUES (:fileName,:fileSize,:fileType,:userId)') ;
            //     $stmt->execute(array(
            //         ':fileName' => 'default.png',
            //         ':fileType' => 'image/png',
            //         ':userId' => $userId

            //     ));

            //     header('Location: /?action=added');
            //     exit;

            // } catch(PDOException $e) {
            //     echo $e->getMessage();
            // }
    
        }

    // if (! in_array($fileExtension,$fileExtensions)) {
    //     $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    // }

    // if ($fileSize > 2000000) {
    //     $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
    // }

    // if (empty($errors)) {
    //     $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

    //     if ($didUpload) {
    //         echo "The file " . basename($fileName) . " has been uploaded";
    //     } else {
    //         echo "An error occurred somewhere. Try again or contact the admin";
    //     }
    // } else {
    //     foreach ($errors as $error) {
    //         echo $error . "These are the errors" . "\n";
    //     }
    // }

    // if(!isset($error)){
    
    //     try {

    //         //insert into database
    //         $stmt = $db->prepare('INSERT INTO userImage (fileName,fileSize,fileType) VALUES (:fileName,:fileSize,:fileType)') ;
    //         $stmt->execute(array(
    //             ':fileName' => $fileName,
    //             ':fileSize' => $fileSize,
    //             ':fileType' => $fileType
    //         ));

    //         header('Location: /?action=added');
    //         exit;

    //     } catch(PDOException $e) {
    //         echo $e->getMessage();
    //     }

    // }
}