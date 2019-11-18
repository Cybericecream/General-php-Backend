<?php
include($_SERVER['DOCUMENT_ROOT'] . 'includes/database.php');
$projectsId = $_GET['projectsId'];
$userId = $_GET['userId'];
$db->query("DELETE FROM 'user-projects' WHERE userId = $userId AND projectsId = $projectsId");

echo $projectsId . ' ' . $userId;

header("Location: /editProject.php?id=" . $projectsId); 