<?php
include($_SERVER['DOCUMENT_ROOT'] . 'includes/database.php');

include($_SERVER['DOCUMENT_ROOT'] . 'includes/userLoggedIn.php');

$id = $_GET['id'];

if (isset($_POST['submit'])) {

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