<?php
include($_SERVER['DOCUMENT_ROOT'] . 'includes/database.php');
$id = $_GET['id'];
// $db->query("UPDATE FROM 'projects' WHERE id = $id");
echo $id;

$stmt = $db->query("SELECT * FROM 'projectsImage' WHERE projectsId = $id");
while ($row = $stmt->fetch()) {
    echo $row['fileName']."<br />\n";
    $qwerty = $row['fileName'];
}

if (isset($_POST['contributor'])) {

    //collect form data
    extract($_POST);  

    try {

        //insert into database
        $stmt = $db->prepare('INSERT INTO "user-projects" (userId,projectsId) VALUES (:userId,:projectsId)') ;
        $stmt->execute(array(
              ':userId' => $_POST['newUser'],
              'projectsId' => $id
        ));

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    header('Location: /editProject.php?id=' . $id);
    exit;

}

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

    $img = 2;

    $admin = 0;

    echo $projectsTitle . '<br />' . $projectsDescription;

    if(isset($_FILES['image'])){
        $errors= array();
        $fileName = $_FILES['image']['name'];
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
           move_uploaded_file($fileTmp,"img/screenshots/". $_SESSION["user"] . '-' . $fileName);
           echo "Success";
        }else{
           print_r($errors);
        }
     }

    if(!isset($error)){

         try {
            echo $id;
            //insert FROM database
            $stmt = $db->prepare("UPDATE 'projects' SET title=:title, description=:description, domain=:domain, github=:github WHERE id=$id") ;
            $stmt->execute(array(

                ':title' => $projectsTitle,
                ':description' => $projectsDescription,
                ':domain' => $projectsDomain,
                ':github' => $projectsGithub
                
            ));

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $projectIdtodb = $db->lastInsertId();
        echo $qwerty;
        echo $fileName;
        if ($fileName != null && $fileName != $qwerty){
         try {

               //insert FROM database
               $stmt = $db->prepare("UPDATE 'projectsImage' SET fileName=:fileName, fileSize=:fileSize, fileType=:fileType WHERE projectsId=$id") ;
               $stmt->execute(array(
                  ':fileName' => $_SESSION["user"] . '-' . $fileName,
                  ':fileSize' => $fileSize,
                  ':fileType' => $fileType
               ));

               

         } catch(PDOException $e) {
               echo $e->getMessage();
         }
      }

    //     try {

    //      //insert FROM database
    //      $stmt = $db->prepare("UPDATE 'user-projects' SET userId=:userId, projectsId=:projectsId WHERE id = $id") ;
    //      $stmt->execute(array(
    //            ':userId' => $_SESSION['userId'],
    //            'projectsId' => $projectIdtodb
    //      ));

    //  } catch(PDOException $e) {
    //      echo $e->getMessage();
    //  }

      header('Location: /dash.php?action=added');
      exit;

    }

}