<?php

include($_SERVER['DOCUMENT_ROOT'] . 'includes/database.php');

if (isset($_POST['submit'])) {

    //collect form data
    extract($_POST);    

    //very basic validation
    if($projectsTitle ==''){
        $error[] = 'Please enter A title.';
    }
    if($projectsDescription ==''){
        $error[] = 'Please enter a Description.';
    }

    $projectsTitle = htmlspecialchars($projectsTitle);

    $projectsDescription = htmlspecialchars($projectsDescription);

    $projectsDomain = htmlspecialchars($projectsDomain);

    $projectsGithub = htmlspecialchars($projectsGithub);

    $img = 2;

    $admin = 0;

    echo $projectsTitle . '<br />' . $projectsDescription;


    if(isset($_FILES['image'])){
        $errors= array();
        $fileName = $_SESSION["user"] . '-' . $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileTmp = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type'];
        $tmp = explode('.',$_FILES['image']['name']);
        $fileExt=strtolower(end($tmp));
        
        $extensions= array("jpeg","jpg","png");
        
        if(in_array($fileExt,$extensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($fileSize > 2097152) {
           $errors[]='File size must be excately 2 MB';
        }
        
        if(empty($errors)==true) {
           move_uploaded_file($fileTmp,"img/screenshots/".$fileName);
           echo "Success";
        }else{
           print_r($errors);
        }
     }


         try {

            //insert into database
            $insertProject = $db->prepare("INSERT INTO 'projects' (title,description,domain,github) VALUES (:title,:description,:domain,:github)") ;
            $insertProject->execute(array(

                ':title' => $projectsTitle,
                ':description' => $projectsDescription,
                ':domain' => $projectsDomain,
                ':github' => $projectsGithub
                
            ));

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $projectIdtodb = $db->lastInsertId();

        try {

            //insert into database
            $linkUsersProjects = $db->prepare('INSERT INTO "user-projects" (userId,projectsId) VALUES (:userId,:projectsId)') ;
            $linkUsersProjects->execute(array(
                  ':userId' => $_SESSION['userId'],
                  ':projectsId' => $projectIdtodb
            ));
   
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        if ($fileName != null){
         try {

               //insert into database
               $insertImages = $db->prepare('INSERT INTO projectsImage (fileName,fileSize,fileType,projectsId,userId) VALUES (:fileName,:fileSize,:fileType,:projectsId,:userId)') ;
               $insertImages->execute(array(
                  ':fileName' => $fileName,
                  ':fileSize' => $fileSize,
                  ':fileType' => $fileType,
                  ':projectsId' => $projectIdtodb,
                  ':userId' => $_SESSION['userId']
               ));

               

         } catch(PDOException $e) {
               echo $e->getMessage();
         }
      }

      header('Location: /dash.php?action=added');
      exit;


}